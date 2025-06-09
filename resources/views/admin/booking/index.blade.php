@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-admin') 
@endsection

@section('content')
<h2 class="text-maroon fw-bold">Daftar Booking Masuk</h2>

<form action="{{ route('admin.booking.index') }}" method="GET" class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Cari NIM atau Nama Ruang..." value="{{ request('search') }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-danger"><i class="bi bi-search"></i> Cari</button>
    </div>
</form>

<table class="table table-bordered bg-white shadow-sm text-center">
    <thead class="table-light">
        <tr>
            <th>KTM</th>
            <th>NIM</th>
            <th>Ruang</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
            <th style="width: 180px;">Aksi</th>
            <th>Lainnya</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($bookings as $booking)
        <tr>
            <td>
                @if($booking->upload_ktm)
                    <img src="{{ asset('storage/' . $booking->upload_ktm) }}" width="80" class="rounded shadow-sm ktm-thumb" alt="Foto {{ $booking->nama }}" style="cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modalFotoKTM" data-src="{{ asset('storage/' . $booking->upload_ktm) }}">
                @else
                    <span class="text-muted">Tidak ada foto</span>
                @endif
            </td>
            <td>{{ $booking->user->nim ?? '-' }}</td>
            <td>{{ $booking->ruang->nama ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->tanggal_booking)->translatedFormat('d F Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($booking->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->waktu_selesai)->format('H:i') }}</td>
            <td>
                @if ($booking->status_user == 'approved')
                    <span class="badge bg-success">Disetujui</span>
                @elseif ($booking->status_user == 'rejected')
                    <span class="badge bg-danger">Ditolak</span>
                @else
                    <span class="badge bg-warning text-dark">Pending</span>
                @endif
            </td>
            <td>
                @if ($booking->status_user == 'pending')
                    <form action="{{ route('admin.booking.approve', $booking->id) }}" method="POST" class="d-inline approve-form">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success me-1">
                            <i class="bi bi-check-circle"></i> Setujui
                        </button>
                    </form>
                    
                    <button 
                    class="btn btn-sm btn-danger btn-tolak" 
                    data-bs-toggle="modal" 
                    data-bs-target="#tolakModal" 
                    data-booking-id="{{ $booking->id }}">
                    <i class="bi bi-x-circle"></i> Tolak
                    </button>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td>
                <!-- Tombol Lihat Tujuan -->
                <button type="button" class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#tujuanModal{{ $booking->id }}">
                    <i class="bi bi-eye"></i>
                </button>

                <!-- Tombol Hapus -->
                <form action="{{ route('admin.booking.destroy', $booking->id) }}" method="POST" class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>

                <!-- Modal Tujuan -->
                <div class="modal fade" id="tujuanModal{{ $booking->id }}" tabindex="-1" aria-labelledby="tujuanModalLabel{{ $booking->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="tujuanModalLabel{{ $booking->id }}">Tujuan Penggunaan Ruang</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ $booking->tujuan ?? 'Tidak ada tujuan' }}</p>
                    </div>
                    </div>
                </div>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Tidak ada data booking.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Modal Tolak Booking -->
<div class="modal fade" id="tolakModal" tabindex="-1" aria-labelledby="modalTolakBookingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.booking.reject') }}" method="POST" id="tolakForm">
        @csrf
        <input type="hidden" name="booking_id" id="bookingIdInput">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="modalTolakBookingLabel">Tolak Booking</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Masukkan alasan penolakan booking:</p>
          <textarea name="alasan" class="form-control" rows="3" placeholder="Contoh: Ruang sedang maintenance atau jadwal bentrok..." required></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.querySelectorAll('.btn-tolak').forEach(button => {
        button.addEventListener('click', function() {
        const bookingId = this.getAttribute('data-booking-id');
        document.getElementById('bookingIdInput').value = bookingId;
        });
    });
  </script>
</div>

{{-- Modal Lihat Foto KTM --}}
<div class="modal fade" id="modalFotoKTM" tabindex="-1" aria-labelledby="modalFotoKTMLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFotoKTMLabel">Foto KTM</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="fotoKtmBesar" src="" alt="Foto KTM" class="img-fluid rounded shadow-sm" style="max-height: 500px;">
      </div>
    </div>
  </div>
</div>

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

@if(session('info'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: "{{ session('info') }}",
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Konfirmasi setujui
    document.querySelectorAll('.approve-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Setujui booking?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, setujui',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Konfirmasi hapus
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus booking?',
                text: "Data booking akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const thumbnails = document.querySelectorAll('.ktm-thumb');
    const imgPreview = document.getElementById('fotoKtmBesar');

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function () {
            const src = this.getAttribute('data-src');
            imgPreview.setAttribute('src', src);
        });
    });
});
</script>
@endsection
