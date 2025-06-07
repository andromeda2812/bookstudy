<style>
    .custom-maroon {
        border: 2px solid #A42421;
        color: #A42421;
        font-weight: bold;
        background-color: transparent;
    }

    .custom-maroon:hover {
        background-color: #B82424;
        color: white;
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
        <a href="{{ url()->previous() }}" class="btn custom-maroon">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</nav>