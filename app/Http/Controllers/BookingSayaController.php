<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookingSayaController extends Controller
{
    // Pastikan user harus login untuk mengakses method ini
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan daftar booking milik user yang login
    public function index()
    {
        $userId = Auth::id();

        $bookings = Booking::with('ruang')
                    ->where('user_id', $userId)
                    ->orderBy('tanggal_booking', 'desc')
                    ->orderBy('waktu_mulai', 'desc')
                    ->get();

        return view('booking.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['ruang', 'user'])->where('user_id', Auth::id())->findOrFail($id);
        return view('booking.show', compact('booking'));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        // Hapus file KTM jika ada
        if ($booking->upload_ktm && Storage::disk('public')->exists($booking->upload_ktm)) {
            Storage::disk('public')->delete($booking->upload_ktm);
        }

        $booking->delete();

        return redirect()->back()->with('success', 'Booking berhasil dihapus.');
    }

}
