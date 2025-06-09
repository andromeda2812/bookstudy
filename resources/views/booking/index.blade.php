@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user')
@endsection

@section('content')
    <h2 class="text-maroon fw-bold mb-4">Riwayat Booking Saya</h2>

    <div class="row">
        @forelse ($bookings as $booking)
            <div class="col-md-6 mb-4">
                <div class="card border-0" style="background-color: #F1EDE1; border-radius: 0px; box-shadow: 0 0 12px rgba(0,0,0,0.15);">
                    <div class="card-body">
                        <h5 class="card-title">{{ $booking->ruang->nama ?? 'Ruang Tidak Dikenal' }}</h5>
                        <p class="card-text">Tanggal: {{ \Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d F Y') }}</p>
                        <p class="card-text">Jam: {{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}</p>

                        {{-- Status Booking dalam Bahasa Indonesia --}}
                        @php
                            $statusLabel = '';
                            if ($booking->status_user === 'approved') {
                                $statusLabel = 'Disetujui';
                            } elseif ($booking->status_user === 'rejected') {
                                $statusLabel = 'Ditolak';
                            } else {
                                $statusLabel = 'Pending';
                            }
                        @endphp

                        <span class="badge 
                            @if($booking->status_user == 'approved') bg-success
                            @elseif($booking->status_user == 'rejected') bg-danger
                            @else bg-warning text-dark @endif">
                            Status: {{ $statusLabel }}
                        </span>

                        <button class="btn btn-outline-maroon mt-2 w-100" data-bs-toggle="modal" data-bs-target="#detailModal{{ $booking->id }}">
                            Lihat Detail
                        </button>
                        <form action="{{ route('booking.destroy', $booking->id) }}" method="POST" class="mt-2 delete-booking-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-100">Hapus</button>
                        </form>
                    </div>

                    <!-- Modal Detail Booking -->
                    <div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $booking->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0" style="background-color: #fffdf9;">
                        <div class="modal-header" style="background-color: #800000; color: white;">
                            <h5 class="modal-title" id="detailModalLabel{{ $booking->id }}">Detail Booking</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            @if ($booking->status_user === 'approved')
                                <!-- Tampilan Tiket (jika disetujui) -->
                                <div class="text-center p-2" id="ticketCard{{ $booking->id }}">
                                    <img src="{{ asset('img/logo-bookstudy.png') }}" alt="Logo" width="60" class="mb-2">
                                    <h4 class="text-maroon fw-bold mb-0">Tiket Booking Ruang Studi</h4>
                                    <small class="text-muted">BookStudy | Universitas Jambi</small>
                                    <hr style="border-top: 1.5px solid #800000; width: 60%; margin: 1rem auto;">

                                    <table class="table table-borderless text-start w-75 mx-auto fs-6">
                                        <tr><th class="w-50">Nama</th><td>: {{ $booking->user->nama }}</td></tr>
                                        <tr><th>NIM</th><td>: {{ $booking->user->nim }}</td></tr>
                                        <tr><th>Ruang</th><td>: {{ $booking->ruang->nama }}</td></tr>
                                        <tr><th>Tanggal</th><td>: {{ \Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d F Y') }}</td></tr>
                                        <tr><th>Waktu</th><td>: {{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}</td></tr>
                                        <tr><th>Status</th><td>: <span class="badge bg-success">Disetujui</span></td></tr>
                                    </table>

                                    <div class="mt-3 text-muted fst-italic">Tunjukkan tiket ini saat memasuki ruang studi</div>
                                    <button onclick="downloadTicket('ticketCard{{ $booking->id }}')" class="btn btn-outline-maroon mt-3 px-4 shadow-sm">
                                        <i class="bi bi-download me-1"></i> Simpan sebagai Gambar
                                    </button>
                                </div>
                            @else
                                <!-- Tampilan Detail (Pending / Ditolak) -->
                                <ul class="list-group list-group-flush mb-3">
                                    <li class="list-group-item"><strong>Ruang:</strong> {{ $booking->ruang->nama }}</li>
                                    <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d F Y') }}</li>
                                    <li class="list-group-item"><strong>Jam:</strong> {{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}</li>
                                    <li class="list-group-item"><strong>Status:</strong>
                                        @if ($booking->status_user == 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </li>
                                    <li class="list-group-item"><strong>Tujuan:</strong> {{ $booking->tujuan }}</li>
                                </ul>

                                @if($booking->status_user == 'pending')
                                    <div class="alert alert-info text-center">Booking masih menunggu persetujuan.</div>
                                @elseif($booking->status_user == 'rejected')
                                    <div class="alert alert-danger">
                                        <div><strong>Alasan Penolakan:</strong><br> {{ $booking->alasan_penolakan ?? 'Tidak ada alasan diberikan.' }}</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">Kamu belum melakukan booking ruang.</div>
            </div>
        @endforelse
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>
    function downloadTicket(id) {
        html2canvas(document.getElementById(id)).then(canvas => {
            let link = document.createElement('a');
            link.download = 'tiket-booking.png';
            link.href = canvas.toDataURL("image/png");
            link.click();
        });
    }

    // Konfirmasi Hapus Booking
    document.querySelectorAll('.delete-booking-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data booking akan dihapus permanen.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#800000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif
@endsection