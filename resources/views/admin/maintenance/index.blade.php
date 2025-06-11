@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-admin') 
@endsection

@section('content')
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

<h2 class="text-maroon fw-bold">Jadwal Maintenance Ruang Studi</h2>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
        @forelse ($maintenances as $maintenance)
        <tr>
            <td>{{ $maintenance->ruang->nama ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($maintenance->tanggal)->translatedFormat('d F Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($maintenance->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($maintenance->waktu_selesai)->format('H:i') }}</td>
            <td>{{ $maintenance->keterangan }}</td>
            <td>
                <form action="{{ route('admin.maintenance.destroy', $maintenance->id) }}" method="POST" class="form-hapus" data-ruang="{{ $maintenance->ruang->nama }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" type="button" onclick="konfirmasiHapus(this)">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5">Tidak ada jadwal maintenance.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Modal Tambah Jadwal --}}
<div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-labelledby="modalTambahJadwalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.maintenance.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-maroon text-white">
          <h5 class="modal-title" id="modalTambahJadwalLabel">Tambah Jadwal Maintenance</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Ruang</label>
                <select name="ruang_id" class="form-select" required>
                    <option selected disabled>Pilih Ruang</option>
                    @foreach ($ruangs as $ruang)
                        <option value="{{ $ruang->id }}">{{ $ruang->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Waktu</label>
                <div class="row g-2">
                    <div class="col">
                        <input type="time" name="waktu_mulai" class="form-control" required placeholder="Mulai">
                    </div>
                    <div class="col">
                        <input type="time" name="waktu_selesai" class="form-control" required placeholder="Selesai">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" placeholder="Misal: Perbaikan listrik, pembersihan rutin..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Batal</button>
            <button type="submit" class="btn btn-maroon">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function konfirmasiHapus(button) {
        const form = button.closest('form');
        const ruang = form.dataset.ruang;

        Swal.fire({
            title: 'Yakin hapus?',
            text: `Jadwal maintenance ${ruang} akan dihapus.`,
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
    }
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