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
</style>

@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user') 
@endsection

@section('content')
<div class="text-center my-5">
    <h2 class="fw-bold" style="color: #A42421;">Selamat Datang, User!</h2>
    <p class="text-maroon">Silahkan booking ruang atau lihat riwayat anda</p>
</div>

<div class="row justify-content-center mb-5">
    <div class="col-md-4">
        <div class="card text-center shadow-sm" style="background-color: #DAC0C0; border: 1.5px solid #A42421; border-radius: 8px;">
            <div class="card-body">
                <i class="bi bi-journal-plus fs-2 mb-2" style="color: #A42421;"></i>
                <h5 class="fw-bold" style="color: #A42421;">Booking</h5>
                <p class="" style="color: #A42421;">Pesan ruang belajar dengan cepat dan mudah</p>
                <a href="{{ route('ruangan.index') }}" class="btn btn-hover-maroon" style="border: 1.5px solid #A42421; color: #A42421;">Booking Sekarang</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center shadow-sm" style="background-color: #DAC0C0; border: 1.5px solid #A42421; border-radius: 8px;">
            <div class="card-body">
                <i class="bi bi-clock-history fs-2 mb-2" style="color: #A42421;"></i>
                <h5 class="fw-bold" style="color: #A42421;">Riwayat</h5>
                <p class="" style="color: #A42421;">Lihat riwayat booking yang sudah anda lakukan</p>
                <a href="{{ route('booking.index') }}" class="btn btn-hover-maroon" style="border: 1.5px solid #A42421; color: #A42421;">Lihat Riwayat</a>
            </div>
        </div>
    </div>
</div>
@endsection