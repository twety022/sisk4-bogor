<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    // 1. Tampilkan Admin Aktif
    public function index()
    {
        $admins = User::where('blocked', false)
            ->orderByRaw("role = 'super_admin' desc")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.admins.index', ['admins' => $admins]);
    }

    // 2. Tampilkan Admin Terarsip / Terblokir
    public function archived()
    {
        $archivedAdmins = User::where('blocked', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.admins.archived', ['admins' => $archivedAdmins]);
    }

    // 3. Tambah Admin Baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', Password::min(8), 'confirmed'],
        ]);

        (new User())->forceFill([
            'name'              => $data['name'],
            'email'             => $data['email'],
            'password'          => Hash::make($data['password']),
            'role'              => 'admin',
            'blocked'           => false,
            'email_verified_at' => now(),
        ])->save();

        return redirect()->route('admin.admins.index')->with('success', 'Admin baru berhasil ditambahkan.');
    }

    // 4. Toggle Blokir / Unblock
    public function toggleBlock(Request $request, User $user)
    {
        if ($user->id === $request->user()->id) {
            return back()->with('error', 'Kamu tidak bisa memblokir akunmu sendiri.');
        }

        if ($user->role === 'super_admin') {
            return back()->with('error', 'Admin utama tidak bisa diblokir.');
        }

        $blocked = ! $user->blocked;
        $user->forceFill(['blocked' => $blocked])->save();

        if ($blocked) {
            DB::table('sessions')->where('user_id', $user->id)->delete();
            return redirect()->route('admin.admins.index')->with('success', 'Admin berhasil diblokir dan dipindahkan ke Arsip.');
        }

        return redirect()->route('admin.admins.archived')->with('success', 'Blokir berhasil dibuka, admin kembali ke daftar aktif.');
    }

    // 5. Hapus Permanen
    public function destroy(User $user)
    {
        if ($user->role === 'super_admin') {
            return back()->with('error', 'Admin utama tidak bisa dihapus.');
        }

        $user->delete();

        return back()->with('success', 'Admin telah dihapus secara permanen.');
    }
}