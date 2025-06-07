<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\Ruang;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Total booking bulan ini berdasarkan tanggal_booking
        $totalBookingThisMonth = Booking::where('user_id', $user->id)
            ->whereMonth('tanggal_booking', now()->month)
            ->count();

        // Jumlah ruangan yang tersedia
        $availableRoomsCount = Ruang::where('status', 'available')->count();

        // Booking user berikutnya
        $upcomingBooking = Booking::where('user_id', $user->id)
            ->whereDate('tanggal_booking', '>=', now()->toDateString())
            ->orderBy('tanggal_booking', 'asc')
            ->orderBy('waktu_mulai', 'asc')
            ->first();

        return view('dashboard.user', compact('user', 'totalBookingThisMonth', 'availableRoomsCount', 'upcomingBooking'));
    }
}