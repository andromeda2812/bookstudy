<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>BookStudy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #F1EDE1; 
            font-family: 'Segoe UI', sans-serif;
        }

        /* .bg-maroon {
            background-color: #800000 !important;
        } */

        .text-maroon {
            color: #A42421 !important;
        }

        .btn-maroon {
            background-color: #A42421;
            color: white;
            font-weight: bold;
        }

        .btn-maroon:hover {
            background-color: #a83232;
            color: white;
        }

        .btn-outline-maroon {
            border: 2px solid #A42421;
            color: #A42421;
            font-weight: bold;
        }

        .btn-outline-maroon:hover {
            background-color: #A42421;
            color: white;
        }

        .img-banner {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .text-maroon {
            color: #A42421 !important;
        }

        .btn-maroon {
            background-color: #A42421;
            color: white;
            font-weight: bold;
            border: none;
        }

        .btn-maroon:hover {
            background-color: #B82424;
            color: white;
        }

        .card-body table th {
            font-weight: 600;
            color: #3b0a0a;
        }
        footer a:hover {
            color: #ffc107 !important;
        }
    </style>
</head>
<body>
    {{-- Navbar (diisi oleh halaman melalui @section('navbar')) --}}
    @hasSection('navbar')
        @yield('navbar')
    @endif

    @yield('before-content')

    <!-- Main Content -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <footer class="text-white mt-5 py-4" style="background-color: #B82424;">
        <div class="container text-center">
            <div class="mb-3">
                <a href="#" class="text-white mx-2"><i class="bi bi-facebook fs-5"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-instagram fs-5"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-linkedin fs-5"></i></a>
                <a href="#" class="text-white mx-2"><i class="bi bi-envelope fs-5"></i></a>
            </div>
            <div class="mb-2 small">
                <a href="#" class="text-white text-decoration-none mx-2">Tentang Kami</a> |
                <a href="#" class="text-white text-decoration-none mx-2">Kontak</a> |
                <a href="#" class="text-white text-decoration-none mx-2">Kebijakan Privasi</a> |
                <a href="#" class="text-white text-decoration-none mx-2">Syarat & Ketentuan</a>
            </div>
            <div class="text-muted small">© {{ date('Y') }} BookStudy. All rights reserved.</div>
        </div>
    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
