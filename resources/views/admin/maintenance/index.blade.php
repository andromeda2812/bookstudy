<style>
    .custom-maroon-show {
        border: 2px solid #A42421;
        color: #fff !important;
        background-color: #A42421 !important;
        font-weight: bold !important;
    }

    .custom-maroon-show:hover {
        background-color: #F1EDE1 !important;
        color: #A42421 !important;
        text-decoration: underline;
    }
</style>

@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-admin') 
@endsection

@section('content')
<h2 class="text-maroon fw-bold">Jadwal Maintenance Ruang Studi</h2>

<div class="d-flex justify-content-end mb-3">
    <a href="#" class="btn custom-maroon-show" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
        <i class="bi bi-plus-circle me-1"></i> Tambah Jadwal
    </a>
</div>

<table class="table table-bordered shadow-sm bg-white text-center">
    <thead class="table-light">
        <tr>
            <th>Ruang</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Keterangan</th>
            <th style="width: 100px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- Contoh data --}}
        <tr>
            <td>A101</td>
            <td>24 Mei 2025</td>
            <td>08:00 - 12:00</td>
            <td>Maintenance AC dan Pembersihan</td>
            <td>
                <a href="#" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-trash"></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>

{{-- Modal Tambah Jadwal --}}
<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header bg-maroon text-white">
          <h5 class="modal-title" id="modalTambahJadwalLabel">Tambah Jadwal Maintenance</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Ruang</label>
                <select class="form-select">
                    <option selected disabled>Pilih Ruang</option>
                    <option>A101</option>
                    <option>B202</option>
                    <!-- Nanti dinamis dari DB -->
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control">
            </div>
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
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" rows="3" placeholder="Misal: Perbaikan listrik, pembersihan rutin..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-maroon">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<br><br><br>
@endsection