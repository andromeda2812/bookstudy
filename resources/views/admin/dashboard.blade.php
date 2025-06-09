@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-admin')
@endsection

@section('content')
<style>
    .custom-maroon-show {
        border: 2px solid #A42421;
        color: #fff !important;
        background-color: #A42421 !important;
        font-weight: bold !important;
    }

    .custom-maroon-show:hover {
        background-color: #FFF !important;
        color: #A42421 !important;
        text-decoration: underline;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    @keyframes floatY {
    0%   { transform: translateX(-50%) translateY(0); }
    50%  { transform: translateX(-50%) translateY(-10px); }
    100% { transform: translateX(-50%) translateY(0); }
    }

    .animated-image {
        animation: floatY 4s ease-in-out infinite;
        opacity: 0.3;
        position: absolute; /* atau absolute, sesuaikan */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        max-width: 600px;
        z-index: 0;
    }
</style>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h2 class="text-maroon fw-bold">Dashboard Admin</h2>
<p class="text-maroon">Selamat datang di panel pengelola <strong>BookStudy</strong>. Silakan pilih menu untuk mengelola sistem.</p>
<img src="{{ asset('img/admin.png') }}" alt="Ilustrasi" class="animated-image">

<div class="row justify-content-center text-center mt-4">
    <div class="col-md-3 mb-3" data-aos="fade-down">
        <div class="p-4 rounded-3 shadow border-0" style="background-color: #fefefe;">
            <h6 class="fw-bold text-maroon">Total Booking</h6>
            <h3 class="fw-bold text-maroon">{{ $totalBooking }}</h3>
        </div>
    </div>
    <div class="col-md-3 mb-3" data-aos="fade-down" data-aos-delay="100">
        <div class="p-4 rounded-3 shadow border-0" style="background-color: #f8f8f8;">
            <h6 class="fw-bold text-success">Disetujui</h6>
            <h3 class="fw-bold text-success">{{ $approvedBooking }}</h3>
        </div>
    </div>
    <div class="col-md-3 mb-3" data-aos="fade-down" data-aos-delay="200">
        <div class="p-4 rounded-3 shadow border-0" style="background-color: #f8f8f8;">
            <h6 class="fw-bold text-danger">Ditolak</h6>
            <h3 class="fw-bold text-danger">{{ $rejectedBooking }}</h3>
        </div>
    </div>
    <div class="col-md-3 mb-3" data-aos="fade-down" data-aos-delay="300">
        <div class="p-4 rounded-3 shadow border-0" style="background-color: #f8f8f8;">
            <h6 class="fw-bold text-warning">Menunggu</h6>
            <h3 class="fw-bold text-warning">{{ $pendingBooking }}</h3>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-4 mb-4" data-aos="fade-up-right" data-aos-delay="200" data-aos-duration="800">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-door-open-fill fs-1 text-maroon mb-3"></i>
                <h5 class="card-title fw-bold">Manajemen Ruangan</h5>
                <p class="card-text">Tambah, ubah, dan hapus data ruang studi.</p>
                <a href="{{ url('/admin/ruangan') }}" class="btn custom-maroon-show w-100">Kelola Ruangan</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4" data-aos="zoom-in-down" data-aos-delay="200" data-aos-duration="800">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-journal-check fs-1 text-maroon mb-3"></i>
                <h5 class="card-title fw-bold">Booking Masuk</h5>
                <p class="card-text">Lihat dan setujui/menolak permintaan booking.</p>
                <a href="{{ url('/admin/booking') }}" class="btn custom-maroon-show w-100">Kelola Booking</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4" data-aos="fade-up-left" data-aos-delay="200" data-aos-duration="800">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-calendar-x-fill fs-1 text-maroon mb-3"></i>
                <h5 class="card-title fw-bold">Jadwal Maintenance</h5>
                <p class="card-text">Tentukan jadwal ruang tidak tersedia.</p>
                <a href="{{ url('/admin/maintenance') }}" class="btn custom-maroon-show w-100">Atur Jadwal</a>
            </div>
        </div>
    </div>
</div>
@endsection