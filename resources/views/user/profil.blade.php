@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user')
@endsection

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-lg rounded-4 border-0" style="background: linear-gradient(135deg, #F1EDE1 0%, #C9B99A 100%); transition: transform 0.3s ease;">
            <div class="card-body p-5 text-center">
                {{-- Avatar bulat dengan inisial nama --}}
                <div class="mx-auto mb-4 rounded-circle bg-maroon text-white d-flex align-items-center justify-content-center" 
                     style="width: 110px; height: 110px; font-size: 48px; font-weight: 700; user-select: none;">
                    {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                </div>

                <h3 class="text-maroon fw-bold mb-3">{{ auth()->user()->nama }}</h3>

                <p class="text-dark mb-2">
                    <i class="bi bi-person-badge-fill me-2"></i>
                    <strong>NIM:</strong> {{ auth()->user()->nim }}
                </p>
                <p class="text-dark mb-4">
                    <i class="bi bi-envelope-fill me-2"></i>
                    <strong>Email:</strong> {{ auth()->user()->email }}
                </p>

                <!-- Tombol untuk buka modal -->
                <button type="button" class="btn btn-maroon text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                    Edit Profil
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('profil.update') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header bg-maroon text-white">
            <h5 class="modal-title" id="editProfilModalLabel">Edit Profil</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', auth()->user()->nama) }}" class="form-control @error('nama') is-invalid @enderror" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" name="nim" id="nim" value="{{ old('nim', auth()->user()->nim) }}" class="form-control @error('nim') is-invalid @enderror" required>
                @error('nim')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <hr>

            <p class="mb-2 fw-semibold">Ganti Password (opsional)</p>

            <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak ingin ganti password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Konfirmasi password baru">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-maroon text-white">Simpan Perubahan</button>
        </div>
    </form>
  </div>
</div>

<style>
    .text-maroon {
        color: #800000;
    }
    .bg-maroon {
        background-color: #800000;
    }
    .btn-maroon {
        background-color: #800000;
    }
    .btn-maroon:hover {
        background-color: #5c0000;
    }
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 30px rgba(128, 0, 0, 0.4);
    }
</style>
@endsection
