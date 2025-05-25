@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-regisuser') 
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="text-maroon fw-bold mb-4 text-center">Registrasi Mahasiswa</h4>

                <form>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nim" placeholder="Masukkan Nama">
                    </div>     

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" placeholder="Masukkan NIM">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" placeholder="Buat kata sandi">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Ulangi kata sandi">
                    </div>

                    <button type="submit" class="btn btn-maroon w-100">Daftar</button>
                </form>

                <p class="mt-3 text-center">Sudah punya akun? <a href="{{ route('login') }}" class="text-maroon fw-bold">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>
@endsection