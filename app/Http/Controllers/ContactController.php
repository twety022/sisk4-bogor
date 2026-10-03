<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $info = ContactInfo::first() ?? new ContactInfo();

        return view('contact.index', ['info' => $info]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'phone'   => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'message.required' => 'Isi pesan wajib diisi.',
        ]);

        ContactMessage::create($validated);

        return redirect()
            ->route('contact.index')
            ->with('success', 'Pesan kamu berhasil dikirim! Kami akan segera menghubungi balik.');
    }
}
