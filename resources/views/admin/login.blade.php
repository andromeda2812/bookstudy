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

                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan kata sandi">
                    </div>

                    <button type="submit" class="btn btn-maroon w-100">Login Admin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection