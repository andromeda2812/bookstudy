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
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-maroon fw-bold mb-0">Manajemen Ruang Studi</h2>
    <a href="#" class="btn custom-maroon-show" data-bs-toggle="modal" data-bs-target="#modalTambahRuang">
        <i class="bi bi-plus-lg me-1"></i> Tambah Ruang
    </a>
</div>

<table class="table table-bordered table-hover bg-white shadow-sm text-center">
    <thead class="table-light">
        <tr>
            <th>Foto</th>
            <th>Nama Ruang</th>
            <th>Kapasitas</th>
            <th>Deskripsi</th>
            <th style="width: 150px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        {{-- Contoh ruang --}}
        <tr>
            <td>
                <img src="{{ asset('img/ruang1.jpg') }}" width="80" class="rounded shadow-sm">
            </td>
            <td>Ruang A101</td>
            <td>6 Orang</td>
            <td>Gedung A lantai 1 - Cocok untuk diskusi kecil</td>
            <td>
                <a href="#" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#modalEditRuang">
                    <i class="bi bi-pencil"></i>
                </a>
                <a href="#" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></a>
            </td>
        </tr>
        {{-- Tambah baris lain sesuai data --}}
    </tbody>
</table>
{{-- Modal Tambah Ruangan --}}
<div class="modal fade" id="modalTambahRuang" tabindex="-1" aria-labelledby="modalTambahRuangLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form>
        <div class="modal-header bg-maroon text-white">
          <h5 class="modal-title" id="modalTambahRuangLabel">Tambah Ruangan</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="nama" class="form-label">Nama Ruangan</label>
              <input type="text" class="form-control" id="nama" placeholder="Contoh: Ruang A101">
          </div>
          <div class="mb-3">
              <label for="kapasitas" class="form-label">Kapasitas</label>
              <input type="number" class="form-control" id="kapasitas" placeholder="Contoh: 6">
          </div>
          <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="deskripsi" rows="3" placeholder="Contoh: Gedung A lantai 1, cocok untuk diskusi kecil"></textarea>
          </div>
          <div class="mb-3">
              <label for="gambar" class="form-label">Foto Ruangan</label>
              <input type="file" class="form-control" id="gambar">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-maroon">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- Modal Edit Ruangan --}}
<div class="modal fade" id="modalEditRuang" tabindex="-1" aria-labelledby="modalEditRuangLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form>
        <div class="modal-header bg-maroon text-white">
          <h5 class="modal-title" id="modalEditRuangLabel">Edit Ruangan</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="edit-nama" class="form-label">Nama Ruangan</label>
              <input type="text" class="form-control" id="edit-nama" value="Ruang A101">
          </div>
          <div class="mb-3">
              <label for="edit-kapasitas" class="form-label">Kapasitas</label>
              <input type="number" class="form-control" id="edit-kapasitas" value="6">
          </div>
          <div class="mb-3">
              <label for="edit-deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="edit-deskripsi" rows="3">Gedung A lantai 1 - Cocok untuk diskusi kecil</textarea>
          </div>
          <div class="mb-3">
              <label for="edit-gambar" class="form-label">Foto Baru (Opsional)</label>
              <input type="file" class="form-control" id="edit-gambar">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-maroon">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- Modal Edit Ruangan --}}
<div class="modal fade" id="modalEditRuang" tabindex="-1" aria-labelledby="modalEditRuangLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form>
        <div class="modal-header bg-maroon text-white">
          <h5 class="modal-title" id="modalEditRuangLabel">Edit Ruangan</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="edit-nama" class="form-label">Nama Ruangan</label>
              <input type="text" class="form-control" id="edit-nama" value="Ruang A101">
          </div>
          <div class="mb-3">
              <label for="edit-kapasitas" class="form-label">Kapasitas</label>
              <input type="number" class="form-control" id="edit-kapasitas" value="6">
          </div>
          <div class="mb-3">
              <label for="edit-deskripsi" class="form-label">Deskripsi</label>
              <textarea class="form-control" id="edit-deskripsi" rows="3">Gedung A lantai 1 - Cocok untuk diskusi kecil</textarea>
          </div>
          <div class="mb-3">
              <label for="edit-gambar" class="form-label">Foto Baru (Opsional)</label>
              <input type="file" class="form-control" id="edit-gambar">
              <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-maroon">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<br><br><br><br><br><br>
@endsection