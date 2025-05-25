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
    @include('partials.navbar-detailbooking') 
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <!-- Booking Ditolak -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="text-center text-maroon fw-bold mb-3">Detail Booking</h4>

                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item"><strong>Ruang:</strong> Ruang A101</li>
                    <li class="list-group-item"><strong>Tanggal:</strong> 22 Mei 2025</li>
                    <li class="list-group-item"><strong>Jam:</strong> 09:00 - 11:00</li>
                    <li class="list-group-item"><strong>Status:</strong> 
                        <span class="badge bg-danger">Ditolak</span>
                    </li>
                    <li class="list-group-item"><strong>Tujuan:</strong> Diskusi kelompok mata kuliah SI</li>
                </ul>

                <div class="w-100">
                    <a href="{{ route('ruangan.index') }}" class="btn custom-maroon-show mt-3 w-100">
                        Booking Ulang
                    </a>
                </div>
            </div>
        </div>

        <!-- Booking Pending -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <h4 class="text-center text-maroon fw-bold mb-3">Detail Booking</h4>

                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item"><strong>Ruang:</strong> Ruang A101</li>
                    <li class="list-group-item"><strong>Tanggal:</strong> 22 Mei 2025</li>
                    <li class="list-group-item"><strong>Jam:</strong> 09:00 - 11:00</li>
                    <li class="list-group-item"><strong>Status:</strong> 
                        <span class="badge bg-warning">Pending</span>
                    </li>
                    <li class="list-group-item"><strong>Tujuan:</strong> Diskusi kelompok mata kuliah SI</li>
                </ul>

                <div class="w-100">
                    <a href="#" class="btn custom-maroon-show mt-3 w-100">
                        Batalkan Booking
                    </a>
                </div>
            </div>
        </div>

        {{-- Tiket Booking Langsung Muncul --}}
        <div class="card shadow border-0" id="ticketCard" style="background-color: #fffdf9;">
            <div class="card-body text-center p-4">

                {{-- Logo & Judul --}}
                <div class="mb-4">
                    <img src="{{ asset('img/logo-bookstudy.png') }}" alt="Logo" width="60" class="mb-2">
                    <h4 class="text-maroon fw-bold mb-0">Tiket Booking Ruang Studi</h4>
                    <small class="text-muted">BookStudy | Universitas Jambi</small>
                </div>

                <hr style="border-top: 1.5px solid #800000; width: 60%; margin: 1rem auto;">

                {{-- Informasi Tiket --}}
                <table class="table table-borderless text-start w-75 mx-auto fs-6">
                    <tr>
                        <th class="w-50">Nama</th>
                        <td>: Khafifah Najwa</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>: F1E123044</td>
                    </tr>
                    <tr>
                        <th>Ruang</th>
                        <td>: A101 - Gedung A</td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>: 22 Mei 2025</td>
                    </tr>
                    <tr>
                        <th>Waktu</th>
                        <td>: 09:00 - 11:00</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>: <span class="badge bg-success">Disetujui</span></td>
                    </tr>
                </table>

                <div class="mt-4 text-muted fst-italic">
                    Tunjukkan tiket ini saat memasuki ruang studi
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button onclick="downloadTicket()" class="btn custom-maroon-show px-4 shadow-sm">
                        <i class="bi bi-download me-1"></i> Simpan sebagai Gambar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- html2canvas untuk simpan tiket --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    function downloadTicket() {
        html2canvas(document.querySelector("#ticketCard")).then(canvas => {
            let link = document.createElement('a');
            link.download = 'tiket-booking.png';
            link.href = canvas.toDataURL("image/png");
            link.click();
        });
    }
</script>
@endsection