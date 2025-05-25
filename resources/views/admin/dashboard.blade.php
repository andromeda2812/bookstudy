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
</style>


@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-admin') 
@endsection

@section('content')
<h2 class="text-maroon fw-bold">Dashboard Admin</h2>
<p class="text-maroon">Selamat datang di panel pengelola BookStudy. Silakan pilih menu di atas untuk mengelola sistem.</p>

<div class="row mt-4">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-door-open-fill fs-1 text-maroon mb-3"></i>
                <h5 class="card-title fw-bold">Manajemen Ruangan</h5>
                <p class="card-text">Tambah, ubah, dan hapus data ruang studi.</p>
                <a href="#" class="btn custom-maroon-show w-100">Kelola Ruangan</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-journal-check fs-1 text-maroon mb-3"></i>
                <h5 class="card-title fw-bold">Booking Masuk</h5>
                <p class="card-text">Lihat dan setujui/menolak permintaan booking.</p>
                <a href="#" class="btn custom-maroon-show w-100">Kelola Booking</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
                <i class="bi bi-calendar-x-fill fs-1 text-maroon mb-3"></i>
                <h5 class="card-title fw-bold">Jadwal Maintenance</h5>
                <p class="card-text">Tentukan jadwal ruang tidak tersedia.</p>
                <a href="#" class="btn custom-maroon-show w-100">Atur Jadwal</a>
            </div>
        </div>
    </div>
</div>
@endsection