<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Setting;

class NewsController extends Controller
{
    /**
     * Show a single article by its slug.
     * Route: GET /insight/{slug}
     */
    public function show(string $slug)
    {
        $article = News::where('slug', $slug)->firstOrFail();
        $settings = Setting::pluck('value', 'key')->all();

        // Related articles (same category, excluding current)
        $related = News::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        return view('news-detail', compact('article', 'settings', 'related'));
    }
}
