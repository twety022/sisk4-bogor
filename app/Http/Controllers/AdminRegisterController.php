<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminRegisterController extends Controller
{
    public function create()
    {
        $this->ensureEnabled();

        return view('auth.register-admin');
    }

    public function store(Request $request)
    {
        $this->ensureEnabled();

        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', Password::min(8), 'confirmed'],
            'kode'     => ['required', 'string'],
        ]);

        if (! hash_equals((string) config('sisk4.admin_register_key'), $data['kode'])) {
            return back()
                ->withInput($request->only('name', 'email'))
                ->withErrors(['kode' => 'Kode pendaftaran tidak valid.']);
        }

        (new User())->forceFill([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'role'              => 'admin',
            'is_blocked'        => false,
            'email_verified_at' => now(),
        ])->save();

        return redirect()->route('register.admin')
            ->with('success', 'Akun admin berhasil dibuat.');
    }

    private function ensureEnabled(): void
    {
        abort_unless(config('sisk4.admin_register_key'), 404);
    }
}