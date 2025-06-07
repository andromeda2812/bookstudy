<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();

        $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->nama = $request->nama;
        $user->nim = $request->nim;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

       return redirect()->route('profil.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
