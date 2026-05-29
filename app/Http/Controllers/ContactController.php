<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $contact = Contact::create([
            'name' => strip_tags($request->name),
            'email' => strip_tags($request->email),
            'message' => strip_tags($request->message),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan Anda berhasil dikirim!',
            'data' => $contact,
        ]);
    }
}
