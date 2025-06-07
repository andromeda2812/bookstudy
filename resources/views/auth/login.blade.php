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
            </div>
        </div>
    </div>
</div>
@endsection
