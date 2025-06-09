<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalBooking = Booking::count();
        $approvedBooking = Booking::where('status_user', 'approved')->count();
        $rejectedBooking = Booking::where('status_user', 'rejected')->count();
        $pendingBooking = Booking::where('status_user', 'pending')->count();

        return view('admin.dashboard', compact('totalBooking', 'approvedBooking', 'rejectedBooking', 'pendingBooking'));
    }
}