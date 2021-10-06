<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function sendContactForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);


        return response()->json([
            'success' => 'Contact form sent'
        ], 204);

    }
}
