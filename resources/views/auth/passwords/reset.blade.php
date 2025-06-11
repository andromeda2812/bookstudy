@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh">
    <div class="card shadow rounded-4 p-4" style="max-width: 500px; width: 100%;">
        <h4 class="text-center text-maroon fw-bold mb-4">Reset Password</h4>
        <form method="POST" action="{{ $isAdmin ?? false ? route('admin.password.update') : route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control rounded-3" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control rounded-3" required>
            </div>

            <button type="submit" class="btn btn-maroon w-100 rounded-3">
                Reset Password
            </button>
        </form>
    </div>
</div>
@endsection