@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-homeadmin') 
    <br>
@endsection

@section('before-content')
    <div class="text-center">
        <h2 class="text-maroon fw-bold">Selamat Datang di BookStudy, Admin</h2>
        <p>Kelola ruang studi dan permintaan booking secara efisien melalui panel ini.</p>
    </div>

    <div class="container-fluid p-0">
        <img src="{{ asset('img/banner-bookstudy.png') }}" alt="Banner"
             class="img-fluid shadow-sm" style="width: 100%; display: block;">
    </div>
@endsection

@section('content')
<div class="row text-center mb-5">
    <div class="col-md-4">
        <i class="bi bi-door-open-fill display-5 text-maroon"></i>
        <h5 class="fw-bold mt-2">Manajemen Ruangan</h5>
        <p>Tambah, ubah, dan kelola ruang studi sesuai kebutuhan kampus.</p>
    </div>
    <div class="col-md-4">
        <i class="bi bi-journal-check display-5 text-maroon"></i>
        <h5 class="fw-bold mt-2">Kelola Booking</h5>
        <p>Setujui atau tolak permintaan peminjaman ruang dari mahasiswa.</p>
    </div>
    <div class="col-md-4">
        <i class="bi bi-calendar-x-fill display-5 text-maroon"></i>
        <h5 class="fw-bold mt-2">Jadwal Maintenance</h5>
        <p>Atur waktu ruang tidak tersedia karena kegiatan atau pemeliharaan.</p>
    </div>
</div>

<div class="text-center mt-4">
    <h5 class="fw-bold text-maroon">
        <i class="bi bi-clipboard-check-fill"></i> Siap Mengelola Hari Ini?
    </h5>
    <p>Gunakan fitur yang tersedia untuk menjaga kenyamanan dan ketertiban peminjaman ruang studi.</p>
</div>
@endsection