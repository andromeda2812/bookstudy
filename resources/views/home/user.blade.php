@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-homeuser') 
    <br>
@endsection

@section('before-content')
    <div class="text-center">
        <h2 class="text-maroon fw-bold">Selamat Datang di BookStudy</h2>
        <p class="text-maroon">Platform peminjaman ruang studi kelompok secara online.</p>
    </div>

    <div class="container-fluid p-0">
        <img src="{{ asset('img/banner-bookstudy.png') }}" alt="Banner"
             class="img-fluid shadow-sm" style="width: 100%; display: block;">
    </div>
@endsection

@section('content')
<div class="row text-center mt-5 mb-4">
    <div class="col-md-4">
        <i class="bi bi-calendar-check display-5 text-maroon"></i>
        <h5 class="fw-bold mt-2">Booking Mudah</h5>
        <p>Pesan ruang studi kelompok kapan pun, di mana pun.</p>
    </div>
    <div class="col-md-4">
        <i class="bi bi-clock-history display-5 text-maroon"></i>
        <h5 class="fw-bold mt-2">Pilih Jadwal Sendiri</h5>
        <p>Atur waktu sesuai kebutuhan kelompokmu.</p>
    </div>
    <div class="col-md-4">
        <i class="bi bi-bell-fill display-5 text-maroon"></i>
        <h5 class="fw-bold mt-2">Notifikasi Pengingat</h5>
        <p>Dapatkan pengingat otomatis menjelang waktu penggunaan.</p>
    </div>
</div>

<h4 class="text-maroon fw-bold text-center mt-5">Ruangan Populer</h4>
<div class="row text-center mt-3">
    <div class="col-md-4 mb-4">
        <img src="{{ asset('img/ruang1.jpg') }}" class="img-fluid rounded shadow-sm mb-2" alt="Ruang A">
        <h6 class="fw-bold">Ruang Diskusi A</h6>
        <p class="text-muted">Kapasitas 6 orang, AC & proyektor</p>
    </div>
    <div class="col-md-4 mb-4">
        <img src="{{ asset('img/ruang2.jpg') }}" class="img-fluid rounded shadow-sm mb-2" alt="Ruang B">
        <h6 class="fw-bold">Ruang Kreatif B</h6>
        <p class="text-muted">Desain cozy, cocok untuk brainstorming</p>
    </div>
    <div class="col-md-4 mb-4">
        <img src="{{ asset('img/ruang3.jpg') }}" class="img-fluid rounded shadow-sm mb-2" alt="Ruang C">
        <h6 class="fw-bold">Ruang Presentasi C</h6>
        <p class="text-muted">Whiteboard & koneksi HDMI</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6 text-center">
        <blockquote class="fst-italic">"BookStudy bikin koordinasi kelompok makin gumpang. Gak perlu rebutan ruang lagi!"</blockquote>
        <p class="fw-bold mb-0">— Nadia, Mahasiswa SI UNJA</p>
    </div>
    <div class="col-md-6 text-center">
        <blockquote class="fst-italic">"Suka banget fitur pengingatnya. Bikin gak lupa jadwal!"</blockquote>
        <p class="fw-bold mb-0">— Rio, Mahasiswa Ekonomi</p>
    </div>
</div>

<div class="text-center mt-5">
    <h5 class="fw-bold text-maroon"><i class="bi bi-mortarboard-fill"></i> Siap Belajar Lebih Produktif?</h5>
    <p>Gabung sekarang dan nikmati kemudahan booking ruang studi kelompok hanya dalam beberapa klik</p>
</div>
@endsection