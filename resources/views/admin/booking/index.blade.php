@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-admin') 
@endsection

@section('content')
<h2 class="text-maroon fw-bold">Daftar Booking Masuk</h2>

<table class="table table-bordered bg-white shadow-sm text-center">
    <thead class="table-light">
        <tr>
            <th>Nama</th>
            <th>NIM</th>
            <th>Ruang</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Status</th>
            <th style="width: 180px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- Contoh data --}}
        <tr>
            <td>Khafifah Najwa</td>
            <td>F1E123044</td>
            <td>A101</td>
            <td>22 Mei 2025</td>
            <td>09:00 - 11:00</td>
            <td><span class="badge bg-warning text-dark">Pending</span></td>
            <td>
                <a href="#" class="btn btn-sm btn-success me-1">
                    <i class="bi bi-check-circle"></i> Setujui
                </a>
                <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalTolakBooking">
                    <i class="bi bi-x-circle"></i> Tolak
                </a>
            </td>
        </tr>
    </tbody>
</table>

{{-- Modal Tolak Booking --}}
<div class="modal fade" id="modalTolakBooking" tabindex="-1" aria-labelledby="modalTolakBookingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="modalTolakBookingLabel">Tolak Booking</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Masukkan alasan penolakan booking:</p>
            <textarea class="form-control" rows="3" placeholder="Contoh: Ruang sedang maintenance atau jadwal bentrok..."></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Kirim Penolakan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<br><br><br><br><br><br>
@endsection