@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-admin')
@endsection

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card shadow-lg rounded-4 border-0" 
             style="background: linear-gradient(135deg, #F1EDE1 0%, #C9B99A 100%);
                    transition: transform 0.3s ease;">
            <div class="card-body p-5 text-center">
                {{-- Avatar bulat dengan inisial nama --}}
                <div class="mx-auto mb-4 rounded-circle bg-maroon text-white d-flex align-items-center justify-content-center" 
                     style="width: 110px; height: 110px; font-size: 48px; font-weight: 700; user-select: none;">
                    {{ strtoupper(substr(auth('admin')->user()->email, 0, 1)) }}
                </div>

                <h3 class="text-maroon fw-bold mb-3">{{ auth('admin')->user()->email }}</h3>

                <p class="text-dark mb-4">
                    <i class="bi bi-envelope-fill me-2"></i>
                    <strong>Email:</strong> {{ auth('admin')->user()->email }}
                </p>

                <!-- Tombol untuk buka modal ganti kata sandi -->
                <button type="button" class="btn btn-maroon text-white fw-semibold" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    Ganti Kata Sandi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Form Ganti Kata Sandi -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('admin.profil.updatePassword') }}" method="POST" class="modal-content">
        @csrf
        <div class="modal-header bg-maroon text-white">
            <h5 class="modal-title" id="changePasswordModalLabel">Ganti Kata Sandi</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="current_password" class="form-label">Kata Sandi Saat Ini</label>
                <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi Baru</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-maroon text-white">Simpan</button>
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
        border: none;
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