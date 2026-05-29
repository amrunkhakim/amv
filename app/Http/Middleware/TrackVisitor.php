<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Record logging after the request completes for zero latency
        try {
            $uri = $request->getRequestUri();

            // Exclude administrative dashboards, dynamic backend calls, and assets
            if (str_starts_with($uri, '/admin') ||
                str_starts_with($uri, '/api') ||
                str_starts_with($uri, '/storage') ||
                str_starts_with($uri, '/vendor') ||
                $request->ajax()) {
                return $response;
            }

            $ua = $request->header('User-Agent', '');
            $ip = $request->ip() ?? '127.0.0.1';

            // secure SHA-256 IP hash for data privacy
            $ipHash = hash_hmac('sha256', $ip, config('app.key', 'amv_secret_salt'));

            // Detect device type
            $device = 'Desktop';
            if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $ua)) {
                $device = 'Tablet';
            } elseif (preg_match('/(mobi|ipod|phone|blackberry|opera mini|fennec|minimo|symbian|psp|android)/i', $ua)) {
                $device = 'Mobile';
            }

            // Detect Operating System
            $platform = 'Unknown OS';
            $osArray = [
                '/windows nt 10/i' => 'Windows 10/11',
                '/windows nt 6.3/i' => 'Windows 8.1',
                '/windows nt 6.2/i' => 'Windows 8',
                '/windows nt 6.1/i' => 'Windows 7',
                '/macintosh|mac os x/i' => 'Mac OS X',
                '/linux/i' => 'Linux',
                '/ubuntu/i' => 'Ubuntu',
                '/iphone/i' => 'iOS (iPhone)',
                '/ipad/i' => 'iOS (iPad)',
                '/android/i' => 'Android',
                '/blackberry/i' => 'BlackBerry',
            ];
            foreach ($osArray as $regex => $value) {
                if (preg_match($regex, $ua)) {
                    $platform = $value;
                    break;
                }
            }

            // Detect Browsers & Search Crawlers (SEO / GEO relevance)
            $browser = 'Unknown Browser';
            $browserArray = [
                '/google-extended|gemini/i' => 'Google Gemini Bot',
                '/gptbot/i' => 'ChatGPT Bot',
                '/googlebot/i' => 'Google Bot',
                '/applebot/i' => 'Apple Bot',
                '/bingbot/i' => 'Bing Bot',
                '/duckduckbot/i' => 'DuckDuckGo Bot',
                '/chrome/i' => 'Chrome',
                '/firefox/i' => 'Firefox',
                '/safari/i' => 'Safari',
                '/edge/i' => 'Edge',
                '/opera/i' => 'Opera',
            ];
            foreach ($browserArray as $regex => $value) {
                if (preg_match($regex, $ua)) {
                    $browser = $value;
                    break;
                }
            }

            // Extract referrer source hostname
            $referer = $request->header('referer');
            if ($referer) {
                $urlParts = parse_url($referer);
                $referer = $urlParts['host'] ?? $referer;
            } else {
                $referer = 'Direct Access';
            }

            VisitorLog::create([
                'ip_hash' => $ipHash,
                'uri' => $uri,
                'referer' => $referer,
                'device' => $device,
                'platform' => $platform,
                'browser' => $browser,
            ]);

        } catch (\Exception $e) {
            // Silently capture any errors to ensure 100% website uptime
        }

        return $response;
    }
}
