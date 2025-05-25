<style>
.custom-maroon {
    border: 2px solid #A42421;
    color: #A42421;
    background-color: transparent;
}

.custom-maroon:hover {
    background-color: #A42421;
    color: white;
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
                    <a href="{{ route('admin.login') }}" class="btn custom-maroon">
                        <i class="bi bi-box-arrow-in-right me-1 fw-bold fs-5"></i> Login Admin
                    </a>
                </li>
        </div>
    </div>
</nav>