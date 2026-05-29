<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientDocumentController extends Controller
{
    public function mous()
    {
        $mous = auth()->user()->mous()->orderBy('created_at', 'desc')->get();
        return view('portal.documents.mous', compact('mous'));
    }

    public function invoices()
    {
        $invoices = auth()->user()->invoices()->orderBy('issued_date', 'desc')->get();
        return view('portal.documents.invoices', compact('invoices'));
    }
}
