    <style>
        .dropdown-menu .dropdown-item:hover {
            background-color: #B82424;
            color: black;
            text-decoration: underline;
        }

        .navbar .nav-link {
            transition: transform 0.2s ease, box-shadow 0.2s ease, color 0.2s ease;
        }

        .navbar .nav-link:hover {
            transform: scale(1.1);
            color: black !important;
            text-decoration: underline;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border-radius: 5px;
        }
    </style>

<nav class="navbar navbar-expand-lg px-4 py-3" style="background-color: #F1EDE1; border-bottom: 1.5px solid #A42421;">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center fw-bold text-maroon" href="{{ route('home.user') }}">
            <img src="{{ asset('img/logo-bookstudy.png') }}" alt="Logo" width="32" height="32" class="me-2">
            BookStudy
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarUser">
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item fw-bold">
                  <a href="{{ route('dashboard') }}" class="nav-link text-maroon">
    <i class="bi bi-house-door-fill me-1"></i> Dashboard
</a>

                </li>
                <li class="nav-item fw-bold">
                    <a href="{{ route('ruangan.index') }}" class="nav-link text-maroon">
                        <i class="bi bi-check-square me-1"></i> Lihat Ruang Studi
                    </a>
                </li>
                
                <li class="nav-item fw-bold">
                    <a href="{{ route('booking.index') }}" class="nav-link text-maroon">
                        <i class="bi bi-journal-text me-1"></i> Booking Saya
                    </a>
                </li>
                <li class="nav-item dropdown fw-bold">
                    <a class="nav-link dropdown-toggle text-maroon d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-person fs-5 me-1"></i> {{ Auth::user()->name ?? 'User' }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end fw-bold" style="background-color: #A42421;">
                        <li><a class="dropdown-item" href="{{ route('user.profil') }}" style="color: #F1EDE1; font-weight: bold;">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #F1EDE1; font-weight: bold;">
                                Logout
                            </a>
                            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>