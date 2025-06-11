@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-adminlogin') 
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-maroon fw-bold mb-4 text-center">Login Admin</h4>

                {{-- Tampilkan pesan error jika login gagal --}}
                @if(session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Masukkan email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan kata sandi" required>
                    </div>

                    <button type="submit" class="btn btn-maroon w-100">Login Admin</button>
                </form>
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
      <form method="POST" action="{{ route('admin.password.email') }}">
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
                window.location.href = "{{ route('admin.login') }}";
            });
        });
    </script>
@endif
@endsection

