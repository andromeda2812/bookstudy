<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Simpan booking baru.
     */
    public function store(Request $request)
    {
        // Validasi input (tanpa NIM karena diambil dari user login)
        $validated = $request->validate([
            'ruang_id' => 'required|exists:ruang,id',
            'upload_ktm' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal_booking' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'tujuan' => 'required|string',
        ]);

        // Upload file KTM
        if ($request->hasFile('upload_ktm')) {
            $file = $request->file('upload_ktm');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('ktm_uploads', $filename, 'public');
            $validated['upload_ktm'] = $path;
        }

        // Tambahkan user_id dari user yang login
        $validated['user_id'] = Auth::id();

        // Cek bentrok booking
        $existing = Booking::where('ruang_id', $request->ruang_id)
            ->where('tanggal_booking', $request->tanggal_booking)
            ->where(function ($query) use ($request) {
                $query->whereBetween('waktu_mulai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhereBetween('waktu_selesai', [$request->waktu_mulai, $request->waktu_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('waktu_mulai', '<=', $request->waktu_mulai)
                            ->where('waktu_selesai', '>=', $request->waktu_selesai);
                    });
            })
            ->exists();

        if ($existing) {
            return redirect()->back()
                ->withErrors(['waktu_mulai' => 'Ruangan sudah dibooking di jam tersebut.'])
                ->with('booking_failed', true);
        }

        // Simpan booking
        Booking::create($validated);

        return redirect()->back()->with('success', 'Booking berhasil dikirim, menunggu persetujuan.');
    }

    public function cekJadwal($ruangId, $tanggal)
    {
        $bookings = Booking::where('ruang_id', $ruangId)
            ->where('tanggal', $tanggal)
            ->where('status_user', 'approved')
            ->select('jam_mulai', 'jam_selesai')
            ->get();

        return response()->json($bookings);
    }
}