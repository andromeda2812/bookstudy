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
</style>

<nav class="navbar navbar-expand-lg px-4 py-3" style="background-color: #F1EDE1; border-bottom: 1.5px solid #A42421;">
    <div class="container-fluid">
        <a href="{{ url()->previous() }}" class="btn custom-maroon">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</nav>