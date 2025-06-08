<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // Menampilkan halaman dashboard admin
    public function dashboard()
    {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    }

    // Logout admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'],
        ], [
            'password.confirmed' => 'Password baru dan konfirmasi password tidak cocok.',
        ]);

        /** @var Admin $admin */
        $admin = Auth::guard('admin')->user();

        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->with('swal_error', 'Kata sandi saat ini salah.');
        }

        $admin->password = Hash::make($request->password);
        $admin->save();  // <-- error di sini biasanya karena tipe $admin bukan model

        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('swal_success', 'Kata sandi berhasil diperbarui. Silahkan login kembali.');
    }
}
