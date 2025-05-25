<style>
    .btn-maroon {
        background-color: #A42421;
        color: #fff;
        font-weight: bold;
        transition: 0.3s;
    }

    .btn-maroon:hover {
        background-color: #F1EDE1 !important;
        color: #A42421 !important;
        text-decoration: underline;
    }
</style>

@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user') 
@endsection

@section('content')
    <div class="mb-5">
        <h2 class="fw-bold" style="color: #A42421;">Daftar Ruang Studi</h2>
        <p class="" style="color: #A42421; opacity: 0.8;">
            Silahkan cek ketersediaan ruang studi sebelum melakukan booking
        </p>
    </div>

    <div class="row">
        {{-- Ruang Tersedia --}}
        <div class="col-md-4 mb-4">
            <div class="card border-0" style="background-color: #F1EDE1; border-radius: 0px; box-shadow: 0 0 12px rgba(0,0,0,0.15);">
                <div class="card-body" style="border-radius: 0px;">
                    <h5 class="fw-bold" style="color: #A42421;">Ruang A101</h5>
                    <p style="color: #A42421;">Kapasitas: 8 Orang</p>
                    <p style="color: #A42421;">Gedung A Lantai 1</p>
                    <span class="badge bg-success mb-3 px-3 py-2">Tersedia</span>
                    <a href="{{ route('booking.create', 1) }}" class="btn btn-maroon w-100 mt-2" style="background-color: #A42421; color: #fff; font-weight: bold;">
                        Booking Ruang
                    </a>
                </div>
            </div>
        </div>

        {{-- Ruang Tidak Tersedia --}}
        <div class="col-md-4 mb-4">
            <div class="card border-0" style="background-color: #F1EDE1; border-radius: 0px; box-shadow: 0 0 12px rgba(0,0,0,0.15);">
                <div class="card-body" style="border-radius: 0px;">
                    <h5 class="fw-bold" style="color: #A42421;">Ruang A102</h5>
                    <p style="color: #A42421;">Kapasitas: 8 Orang</p>
                    <p style="color: #A42421;">Gedung A Lantai 2</p>
                    <span class="badge bg-danger mb-3 px-3 py-2">Tidak Tersedia</span>
                    <button class="btn btn-maroon w-100 mt-2" style="background-color: #9e9e9e; color: white; font-weight: bold;" disabled>
                        Tidak Dapat Dibooking
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection