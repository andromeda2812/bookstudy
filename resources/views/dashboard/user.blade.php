<style>
    .btn-hover-maroon {
        border: 1.5px solid #A42421;
        color: #A42421;
        transition: 0.3s;
    }

    .btn-hover-maroon:hover {
        background-color: #f1ede1 !important;
        color: #A42421 !important;
        text-decoration: underline;

    }
    @keyframes floatY {
    0%   { transform: translateX(-50%) translateY(0); }
    50%  { transform: translateX(-50%) translateY(-10px); }
    100% { transform: translateX(-50%) translateY(0); }
    }

    .animated-image {
    animation: floatY 4s ease-in-out infinite;
    opacity: 0.2;
    position: absolute;
    top: 50px;
    left: 50%;
    transform: translateX(-50%);
    max-width: 850px;
    z-index: 0;
    }
</style>

@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user') 
@endsection

@section('content')
<div class="position-relative text-center my-5">
    <div style="position: relative; z-index: 1;">
        <h2 class="fw-bold text-maroon">Selamat Datang, {{ Auth::user()->nama }}!</h2>
        <p class="text-maroon">Siap belajar hari ini? Yuk booking ruang atau cek riwayatmu!</p>
    </div>
    <img src="{{ asset('img/study-team.png') }}" alt="Ilustrasi" class="animated-image">
</div>

<div class="row justify-content-center mb-4 text-center">
    <div class="col-md-3 mb-3" data-aos="zoom-in" data-aos-duration="700">
        <div class="p-4 rounded-3 shadow-lg border-0" style="background-color: rgba(255, 255, 255, 0.6); backdrop-filter: blur(5px);">
            <h5 class="fw-bold text-maroon">Total Booking Bulan Ini</h5>
            <h2 class="fw-bold text-maroon">{{ $totalBookingThisMonth ?? '0' }}</h2>
        </div>
    </div>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-4 mb-3" data-aos="fade-up-right" data-aos-duration="700">
        <div class="card text-center shadow-lg border-0" style="border-radius: 16px;">
            <div class="card-body" style="background-color: #F6E9E9;">
                <i class="bi bi-journal-plus fs-2 mb-3 text-maroon"></i>
                <h5 class="fw-bold text-maroon">Booking</h5>
                <p class="text-maroon">Pesan ruang belajar dengan cepat dan mudah</p>
                <a href="{{ route('ruangan.index') }}" class="btn btn-outline-maroon w-75">Booking Sekarang</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3" data-aos="fade-up-left" data-aos-duration="700">
        <div class="card text-center shadow-lg border-0" style="border-radius: 16px;">
            <div class="card-body" style="background-color: #F6E9E9;">
                <i class="bi bi-clock-history fs-2 mb-3 text-maroon"></i>
                <h5 class="fw-bold text-maroon">Riwayat</h5>
                <p class="text-maroon">Lihat riwayat booking yang sudah anda lakukan</p>
                <a href="{{ route('booking.index') }}" class="btn btn-outline-maroon w-75">Lihat Riwayat</a>
            </div>
        </div>
    </div>
</div>

@if($upcomingBooking)
<div class="row justify-content-center mb-5">
    <div class="col-md-7">
        <div class="alert text-center shadow-sm" style="background-color: #fff7f7; border-left: 5px solid #A42421;">
            <strong class="text-maroon">Booking Terdekat:</strong> 
            <strong>{{ $upcomingBooking->ruang->nama }}</strong> pada 
            <strong>{{ \Carbon\Carbon::parse($upcomingBooking->tanggal_booking)->translatedFormat('d F Y') }}</strong> 
            pukul <strong>{{ \Carbon\Carbon::parse($upcomingBooking->waktu_mulai)->format('H:i') }}</strong>.
        </div>
    </div>
</div>
@endif
@endsection