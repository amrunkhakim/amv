<?php

namespace App\Http\Controllers;

use App\Models\Mou;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MouController extends Controller
{
    /**
     * Store a newly created MOU.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Generate MOU Number: AMV/MOU/YEAR/COUNT
        $year = date('Y');
        $count = Mou::whereYear('created_at', $year)->count() + 1;
        $mouNumber = sprintf('AMV/MOU/%d/%04d', $year, $count);

        Mou::create([
            'mou_number' => $mouNumber,
            'company_name' => $request->company_name,
            'client_name' => $request->client_name,
            'title' => $request->title,
            'content' => $request->content,
            'verification_token' => Str::random(40),
            'is_signed' => false,
        ]);

        return redirect()->to(route('admin.dashboard').'#mous')->with('success', 'MOU baru berhasil dibuat.');
    }

    /**
     * Delete an MOU.
     */
    public function destroy($id)
    {
        $mou = Mou::findOrFail($id);
        $mou->delete();

        return redirect()->to(route('admin.dashboard').'#mous')->with('success', 'MOU berhasil dihapus.');
    }

    /**
     * Show public signing page.
     */
    public function showSign($token)
    {
        $mou = Mou::where('verification_token', $token)->firstOrFail();
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();

        return view('mou.sign', compact('mou', 'settings'));
    }

    /**
     * Handle public digital signing POST request.
     */
    public function sign(Request $request, $token)
    {
        $mou = Mou::where('verification_token', $token)->firstOrFail();

        $request->validate([
            'signature_data' => 'required|string', // Base64 data URI
        ]);

        // Check if already signed
        if ($mou->is_signed) {
            return redirect()->route('mou.view', $token)->with('info', 'MOU ini sudah ditandatangani.');
        }

        $mou->update([
            'signature_data' => $request->signature_data,
            'signature_date' => now(),
            'is_signed' => true,
        ]);

        return redirect()->route('mou.view', $token)->with('success', 'MOU telah berhasil ditandatangani secara digital.');
    }

    /**
     * Show final official signed MOU page with QR verification.
     */
    public function show($token)
    {
        $mou = Mou::where('verification_token', $token)->firstOrFail();
        $settings = DB::table('settings')->pluck('value', 'key')->toArray();

        return view('mou.view', compact('mou', 'settings'));
    }
}
