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
        @forelse ($ruangs as $ruang)
        <tr>
            <td>
                @if($ruang->foto)
                    <img src="{{ asset('storage/' . $ruang->foto) }}" width="80" class="rounded shadow-sm" alt="Foto {{ $ruang->nama }}">
                @else
                    <span class="text-muted">Tidak ada foto</span>
                @endif
            </td>
            <td>{{ $ruang->nama }}</td>
            <td>{{ $ruang->kapasitas }} Orang</td>
            <td>{{ $ruang->deskripsi ?? '-' }}</td>
            <td>
                {{-- Tombol Edit --}}
                <button class="btn btn-sm btn-outline-primary me-1 btn-edit-ruang"
                    data-id="{{ $ruang->id }}"
                    data-nama="{{ $ruang->nama }}"
                    data-kapasitas="{{ $ruang->kapasitas }}"
                    data-deskripsi="{{ $ruang->deskripsi }}"
                    data-foto="{{ $ruang->foto }}"
                    data-bs-toggle="modal" data-bs-target="#modalEditRuang"
                >
                    <i class="bi bi-pencil"></i>
                </button>

                {{-- Form hapus --}}
                <form action="{{ route('ruang.destroy', $ruang->id) }}" method="POST" class="d-inline form-hapus-ruang">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-outline-danger btn-hapus" data-nama="{{ $ruang->nama }}">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">Data ruang belum tersedia.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Modal Tambah Ruangan --}}
<div class="modal fade" id="modalTambahRuang" tabindex="-1" aria-labelledby="modalTambahRuangLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('ruang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header bg-maroon text-white">
          <h5 class="modal-title" id="modalTambahRuangLabel">Tambah Ruangan</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
              <label for="nama" class="form-label">Nama Ruangan</label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Contoh: Ruang A101" required>
          </div>
          <div class="mb-3">
              <label for="kapasitas" class="form-label">Kapasitas</label>
              <input type="number" name="kapasitas" class="form-control" id="kapasitas" placeholder="Contoh: 6" required>
          </div>
          <div class="mb-3">
              <label for="deskripsi" class="form-label">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" placeholder="Contoh: Gedung A lantai 1, cocok untuk diskusi kecil"></textarea>
          </div>
          <div class="mb-3">
              <label for="foto" class="form-label">Foto Ruangan</label>
              <input type="file" name="foto" class="form-control" id="foto" accept="image/*">
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
      <form id="formEditRuang" action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="modal-header bg-maroon text-white">
          <h5 class="modal-title" id="modalEditRuangLabel">Edit Ruangan</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">
          <div class="mb-3">
              <label for="edit-nama" class="form-label">Nama Ruangan</label>
              <input type="text" name="nama" class="form-control" id="edit-nama" required>
          </div>
          <div class="mb-3">
              <label for="edit-kapasitas" class="form-label">Kapasitas</label>
              <input type="number" name="kapasitas" class="form-control" id="edit-kapasitas" required>
          </div>
          <div class="mb-3">
              <label for="edit-deskripsi" class="form-label">Deskripsi</label>
              <textarea name="deskripsi" class="form-control" id="edit-deskripsi" rows="3"></textarea>
          </div>
          <div class="mb-3">
              <label for="edit-foto" class="form-label">Foto Baru (Opsional)</label>
              <input type="file" name="foto" class="form-control" id="edit-foto" accept="image/*">
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

{{-- Script untuk isi form edit --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.btn-edit-ruang');
        const formEdit = document.getElementById('formEditRuang');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                const kapasitas = this.dataset.kapasitas;
                const deskripsi = this.dataset.deskripsi;

                formEdit.action = `/ruang/${id}`;  // route update (ubah sesuai routing kamu)
                formEdit.querySelector('#edit-id').value = id;
                formEdit.querySelector('#edit-nama').value = nama;
                formEdit.querySelector('#edit-kapasitas').value = kapasitas;
                formEdit.querySelector('#edit-deskripsi').value = deskripsi || '';
            });
        });
    });
</script>

{{-- Script untuk hapus --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // tombol hapus
        const hapusButtons = document.querySelectorAll('.btn-hapus');
        
        hapusButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const nama = this.dataset.nama;

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: `Ruangan "${nama}" akan dihapus permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#A42421',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
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
