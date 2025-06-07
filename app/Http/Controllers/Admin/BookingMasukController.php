<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Ruang;

class BookingMasukController extends Controller
{
   public function index(Request $request)
{
    $query = Booking::with('ruang')->orderBy('tanggal_booking', 'desc');

    if ($request->has('search') && $request->search !== '') {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('nim', 'like', '%' . $search . '%')
              ->orWhereHas('ruang', function ($qr) use ($search) {
                  $qr->where('nama', 'like', '%' . $search . '%');
              });
        });
    }

    $bookings = $query->get();

    return view('admin.booking.index', compact('bookings'));
}


public function approve($id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->status_user !== 'pending') {
        return redirect()->route('admin.booking.index')->with('info', 'Booking sudah diproses.');
    }

    // Update status booking menjadi approved
    $booking->status_user = 'approved';
    $booking->save();

    return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil disetujui.');
}

public function reject(Request $request)
{
    $booking = Booking::find($request->booking_id);

    if (!$booking) {
        return redirect()->back()->with('error', 'Booking tidak ditemukan.');
    }

    $booking->status_user = 'rejected'; // Sesuaikan dengan nama kolom di DB
    $booking->alasan_penolakan = $request->alasan;
    $booking->save();

    return redirect()->back()->with('success', 'Booking berhasil ditolak.');
}

public function destroy($id)
{
    $booking = Booking::findOrFail($id);

    // Simpan id ruang sebelum hapus booking
    $ruang_id = $booking->ruang_id;

    // Hapus booking
    $booking->delete();

    // Update status ruang jadi 1 (tersedia)
    $ruang = Ruang::find($ruang_id);
    if ($ruang) {
        $ruang->status = 1;
        $ruang->save();
    }

    return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dihapus.');
}


}
