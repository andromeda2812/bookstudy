<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Ruang;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingMasukController extends Controller
{
public function index(Request $request)
{
    $query = Booking::with(['ruang', 'user'])->orderBy('tanggal_booking', 'desc');

    // Cek apakah pencarian kosong, jika iya tampilkan semua data
    if (!$request->has('search') || trim($request->search) === '') {
        // Jika query string search ada tetapi kosong, redirect ke halaman tanpa query string
        if ($request->has('search')) {
            return redirect()->route('admin.booking.index');
        }

        // Jika tidak ada search parameter, kembalikan data default
        $bookings = $query->get();
        return view('admin.booking.index', compact('bookings'));
    }

    if ($request->has('search') && $request->search !== '') {
        $search = strtolower(trim($request->search));

        // Pemetaan status pencarian ke nilai di database
        $statusMap = [
            'pending' => 'pending',
            'approved' => 'disetujui',
            'rejected' => 'ditolak',
        ];

        try {
            // Coba parse sebagai tanggal
            $parsedDate = Carbon::parse($search)->format('Y-m-d');

            // Jika berhasil parse, langsung query tanggal_booking saja
            $query->whereDate('tanggal_booking', $parsedDate);

        } catch (\Exception $e) {
            // Kalau gagal parse tanggal, lakukan pencarian umum
            $query->where(function ($q) use ($search, $statusMap) {
                // Pencarian berdasarkan status_user
                if (array_key_exists($search, $statusMap)) {
                    $q->orWhere('status_user', $statusMap[$search]);
                }

                // Pencarian berdasarkan bulan di tanggal_booking
                $bulan = [
                    'januari' => 1, 'februari' => 2, 'maret' => 3, 'april' => 4,
                    'mei' => 5, 'juni' => 6, 'juli' => 7, 'agustus' => 8,
                    'september' => 9, 'oktober' => 10, 'november' => 11, 'desember' => 12,
                ];
                foreach ($bulan as $namaBulan => $angkaBulan) {
                    if (Str::contains($search, $namaBulan)) {
                        $q->orWhereMonth('tanggal_booking', $angkaBulan);
                        break;
                    }
                }

                // Pencarian berdasarkan user dan ruang
                $q->orWhereHas('user', function ($qu) use ($search) {
                    $qu->where('nim', 'like', "%$search%")
                       ->orWhere('nama', 'like', "%$search%");
                })
                ->orWhereHas('ruang', function ($qr) use ($search) {
                    $qr->where('nama', 'like', "%$search%");
                })
                ->orWhere('tujuan', 'like', "%$search%");
            });
        }
    }

    // Ambil data hasil query
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
