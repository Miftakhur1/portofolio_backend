<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

class ContactMessageController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'subjek' => 'required',
        'message' => 'required',
    ]);

    ContactMessage::create([
        ...$validated,
        'dibaca' => false,
    ]);

    // KIRIM EMAIL
    Mail::to('didepan.29@gmail.com')
        ->send(new ContactMessageMail($validated));

    return response()->json(['success' => true]);
}
}
