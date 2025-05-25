@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user') 
@endsection

@section('content')
    <h2 class="text-maroon fw-bold">Riwayat Booking Saya</h2>

    <div class="row">
        {{-- Contoh 1 --}}
        <div class="col-md-6 mb-4">
            <div class="card border-0" style="background-color: #F1EDE1; border-radius: 0px; box-shadow: 0 0 12px rgba(0,0,0,0.15);">
                <div class="card-body" style="border-radius: 0px;">
                    <h5 class="card-title">Ruang A101</h5>
                    <p class="card-text">Tanggal: 22 Mei 2025</p>
                    <p class="card-text">Jam: 09:00 - 11:00</p>
                    <span class="badge bg-warning text-dark">Status: Pending</span>
                    <a href="{{ route('booking.show', 1) }}" class="btn btn-outline-maroon mt-3 w-100">Lihat Detail</a>
                </div>
            </div>
        </div>

        {{-- Contoh 2 --}}
        <div class="col-md-6 mb-4">
            <div class="card border-0" style="background-color: #F1EDE1; border-radius: 0px; box-shadow: 0 0 12px rgba(0,0,0,0.15);">
                <div class="card-body" style="border-radius: 0px;">
                    <h5 class="card-title">Ruang B202</h5>
                    <p class="card-text">Tanggal: 20 Mei 2025</p>
                    <p class="card-text">Jam: 13:00 - 15:00</p>
                    <span class="badge bg-success">Status: Disetujui</span>
                    <a href="{{ route('booking.show', 2) }}" class="btn btn-outline-maroon mt-3 w-100">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
@endsection