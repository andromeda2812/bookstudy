<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi mahasiswa.
     */
    public function show()
    {
        return view('auth.register'); // GANTI dengan nama file Blade-mu yang benar
    }

    /**
     * Menyimpan data registrasi ke tabel users.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:100',
            'nim' => 'required|string|max:20|unique:users,nim',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        // Simpan ke database
        User::create([
            'nama' => $request->input('nama'),
            'nim' => $request->input('nim'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
