@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0" style="background-color: #F1EDE1; border-radius: 0px; box-shadow: 0 0 12px rgba(0,0,0,0.15);">
            <div class="card-body" style="border-radius: 0px;">
                <h4 class="text-maroon fw-bold mb-4">Profil Pengguna</h4>

                <table class="table table-borderless mb-0" style="background-color: #F1EDE1;">
                    <tr>
                        <th class="text-maroon" width="30%" style="background-color: #F1EDE1;">Nama</th>
                        <td style="background-color: #F1EDE1;" class="text-maroon">Khafifah Najwa</td>
                    </tr>
                    <tr>
                        <th class="text-maroon" style="background-color: #F1EDE1;">NIM</th>
                        <td style="background-color: #F1EDE1;" class="text-maroon">F1E123456</td>
                    </tr>
                    <tr>
                        <th class="text-maroon" style="background-color: #F1EDE1;">Email</th>
                        <td style="background-color: #F1EDE1;" class="text-maroon">khafifah@student.unja.ac.id</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<br><br>
@endsection