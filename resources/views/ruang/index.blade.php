@extends('layouts.app')

@section('navbar')
    @include('partials.navbar-user')
@endsection

@section('content')
    <div class="mb-5">
        <h2 class="fw-bold" style="color: #A42421;">Daftar Ruang Studi</h2>
        <p style="color: #A42421; opacity: 0.8;">
            Silahkan cek ketersediaan ruang studi sebelum melakukan booking
        </p>
    </div>
    <div class="row">
        @foreach ($ruangs as $ruang)
            <div class="col-md-4 mb-4">
                <div class="card border-0" style="background-color: #F1EDE1; box-shadow: 0 0 12px rgba(0,0,0,0.15);">
                    @if ($ruang->foto)
                        <img src="{{ asset('storage/' . $ruang->foto) }}" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Foto {{ $ruang->nama }}">
                    @endif
                    <div class="card-body">
                        <h5 class="fw-bold" style="color: #A42421;">{{ $ruang->nama }}</h5>
                        <p style="color: #A42421;">Kapasitas: {{ $ruang->kapasitas }} Orang</p>
                        <p style="color: #A42421;">{{ $ruang->deskripsi ?? '-' }}</p>
                        @if ($ruang->status == 2)
                            <span class="badge bg-warning text-dark mb-3 px-3 py-2">Maintenance</span>
                            <button class="btn btn-secondary w-100 mt-2" disabled>
                                Dalam Maintenance
                            </button>
                            <button 
                                type="button" 
                                class="btn btn-warning w-100 mt-2 open-maintenance-detail-modal" 
                                data-id="{{ $ruang->id }}">
                                Lihat Detail
                            </button>
                        @else
                            <span class="badge bg-success mb-3 px-3 py-2">Tersedia</span>
                            <button 
                                type="button"
                                class="btn btn-maroon w-100 mt-2 open-booking-modal"
                                data-id="{{ $ruang->id }}"
                                data-nama="{{ $ruang->nama }}">
                                Booking Ruang
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- MODAL BOOKING -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="POST" action="{{ route('booking.store') }}" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold text-maroon" id="bookingModalLabel">Form Booking Ruang Studi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="ruang_id" id="modalRuangId">
                    <div class="mb-3">
                        <label class="form-label fw-bold text-maroon">Ruang Studi</label>
                        <input type="text" class="form-control" id="modalRuangNama" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-maroon">Upload KTM</label>
                        <input type="file" name="upload_ktm" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-maroon">Tanggal Booking</label>
                        <input type="date" name="tanggal_booking" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-maroon">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" class="form-control" required>
                            @error('waktu_mulai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-maroon">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" class="form-control" required>
                            @error('waktu_selesai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror                            
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-maroon">Tujuan Penggunaan Ruang</label>
                        <textarea name="tujuan" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-maroon">Kirim Booking</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DETAIL MAINTENANCE -->
    <div class="modal fade" id="maintenanceDetailModal" tabindex="-1" aria-labelledby="maintenanceDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-maroon fw-bold">Detail Maintenance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Tanggal:</strong> <span id="mnt-tanggal"></span></p>
                    <p><strong>Waktu:</strong> <span id="mnt-waktu"></span></p>
                    <p><strong>Keterangan:</strong></p>
                    <p id="mnt-keterangan"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Booking modal
        document.querySelectorAll('.open-booking-modal').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const nama = this.dataset.nama;
                document.getElementById('modalRuangId').value = id;
                document.getElementById('modalRuangNama').value = nama;
                new bootstrap.Modal(document.getElementById('bookingModal')).show();
            });
        });
        
        const tanggalInput = document.querySelector('input[name="tanggal_booking"]');
        const waktuInfo = document.createElement('div');
        waktuInfo.className = 'alert alert-warning mt-2';
        waktuInfo.style.display = 'none';
        tanggalInput.parentElement.appendChild(waktuInfo);

        tanggalInput.addEventListener('change', function () {
            const tanggal = this.value;
            const ruangId = document.getElementById('modalRuangId').value;

            if (!tanggal || !ruangId) return;

            fetch(`/cek-jadwal-booking/${ruangId}/${tanggal}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        waktuInfo.style.display = 'none';
                        waktuInfo.innerHTML = '';
                        return;
                    }

                    let list = '<strong>Waktu yang sudah dibooking:</strong><ul>';
                    data.forEach(b => {
                        list += `<li>${b.jam_mulai} - ${b.jam_selesai}</li>`;
                    });
                    list += '</ul>';

                    waktuInfo.innerHTML = list;
                    waktuInfo.style.display = 'block';
                });
        });

        // Maintenance detail modal
        document.querySelectorAll('.open-maintenance-detail-modal').forEach(button => {
            button.addEventListener('click', function () {
                const ruangId = this.dataset.id;
                fetch(`/maintenance-detail/${ruangId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Data maintenance tidak ditemukan.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById('mnt-tanggal').textContent = data?.tanggal ?? '-';
                        document.getElementById('mnt-waktu').textContent = `${data?.waktu_mulai ?? '-'} - ${data?.waktu_selesai ?? '-'}`;
                        document.getElementById('mnt-keterangan').textContent = data?.keterangan ?? 'Tidak ada keterangan.';
                        new bootstrap.Modal(document.getElementById('maintenanceDetailModal')).show();
                    })
                    .catch(error => {
                        alert('Gagal memuat detail maintenance: ' + error.message);
                    });
            });
        });
    });
</script>

@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new bootstrap.Modal(document.getElementById('bookingModal')).show();
        });
    </script>
@endif

@if (session('booking_failed'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: 'Booking Gagal',
                text: 'Ruangan sudah dibooking di jam yang sama. Silakan pilih waktu lain.',
                confirmButtonColor: '#A42421'
            });
        });
    </script>
@endif

@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        });
    </script>
@endif
@endpush
