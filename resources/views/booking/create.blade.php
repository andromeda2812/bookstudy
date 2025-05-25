<style>
    .btn-maroon:hover {
        background-color: #FFF !important;
        color: #A42421 !important;
        text-decoration: underline;
    }
</style>

@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user') 
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0" style="box-shadow: 0 4px 20px 8px rgba(0, 0, 0, 0.1);">
            <div class="card-body">
                <h4 class="text-center text-maroon fw-bold mb-4">Form Booking Ruang Studi</h4>

                <form>
                    {{-- Nama Ruang --}}
                    <div class="mb-3">
                        <label class="form-label">Ruang Studi</label>
                        <input type="text" class="form-control" value="Ruang A101" readonly>
                    </div>

                    {{-- NIM --}}
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" placeholder="Masukkan NIM">
                    </div>

                    {{-- Upload KTM --}}
                    <div class="mb-3">
                        <label class="form-label">Upload KTM</label>
                        <input type="file" class="form-control">
                    </div>

                    {{-- Tanggal Booking --}}
                    <div class="mb-3">
                        <label class="form-label">Tanggal Booking</label>
                        <input type="date" class="form-control">
                    </div>

                    {{-- Jam Booking --}}
                    <div class="mb-3">
                        <label class="form-label">Waktu</label>
                        <div class="row g-2">
                            <div class="col">
                                <input type="time" class="form-control" placeholder="Mulai">
                            </div>
                            <div class="col">
                                <input type="time" class="form-control" placeholder="Selesai">
                            </div>
                        </div>
                    </div>

                    {{-- Alasan Penggunaan --}}
                    <div class="mb-3">
                        <label class="form-label">Tujuan Penggunaan Ruang</label>
                        <textarea class="form-control" rows="3" placeholder="Contoh: Diskusi kelompok, presentasi, belajar bareng, dll."></textarea>
                    </div>

                    <button type="submit" class="btn btn-maroon w-100">Kirim Permintaan Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection