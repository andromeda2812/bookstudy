<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showProfil()
{
    $user = auth()->user(); // ambil user yang login
    return view('user.profil', compact('user')); // sesuaikan dengan nama view yang kamu pakai
}

    // Menampilkan profil user
    public function profil()
    {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }

    // Menampilkan form edit profil
    public function editProfil()
    {
        $user = Auth::user();
        return view('user.edit-profil', compact('user'));
    }

    // Update data profil user
    public function updateProfil(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'password.confirmed' => 'Password baru dan konfirmasi password tidak cocok.',
        ]);

        $user->nama = $request->nama;
        $user->nim = $request->nim;
        $user->email = $request->email;

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('swal_error', 'Password lama tidak sesuai.');
            }

            $user->password = Hash::make($request->password);
            $user->save();

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('swal_success', 'Profil dan password berhasil diperbarui. Silakan login kembali.');
        }

        $user->save();

       return redirect()->route('profil.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
