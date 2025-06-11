@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-userlogin') 
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-maroon fw-bold mb-4 text-center">Login Mahasiswa</h4>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            name="email" 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            placeholder="Masukkan email" 
                            value="{{ old('email') }}" 
                            required
                            autofocus
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input 
                            name="password" 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            placeholder="Masukkan kata sandi" 
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-maroon w-100">Login</button>
                </form>

                <p class="mt-3 text-center">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-maroon fw-bold">Daftar di sini</a>
                </p>
                <p class="mt-3 text-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalLupaPassword" class="text-maroon">Lupa Password?</a>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lupa Password -->
<div class="modal fade" id="modalLupaPassword" tabindex="-1" aria-labelledby="modalLupaPasswordLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="modalLupaPasswordLabel">Reset Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <p>Masukkan email akun Anda untuk menerima link reset password.</p>
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-maroon">Kirim Link Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('swal_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('swal_success') }}",
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "{{ route('login') }}";
            });
        });
    </script>
@endif
@endsection
