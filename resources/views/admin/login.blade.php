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
            </div>
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

