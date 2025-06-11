<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\BookingMasukController;
use App\Http\Controllers\BookingSayaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\AdminForgotPasswordController;
use App\Http\Controllers\Admin\AdminResetPasswordController;

Route::get('/maintenance-detail/{ruangId}', [MaintenanceController::class, 'detail']);

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AdminController::class, 'logout'])->name('admin_logout');
        Route::post('/admin/booking/reject', [BookingMasukController::class, 'reject'])->name('admin.booking.reject');

        Route::prefix('booking')->name('admin.booking.')->group(function () {
            Route::get('/', [BookingMasukController::class, 'index'])->name('index');
            Route::post('/{id}/approve', [BookingMasukController::class, 'approve'])->name('approve');
        });

        // Route maintenance dipisah di sini
        Route::prefix('maintenance')->name('admin.maintenance.')->group(function () {
            Route::get('/', [MaintenanceController::class, 'index'])->name('index');
            Route::post('/', [MaintenanceController::class, 'store'])->name('store');
            Route::delete('/{id}', [MaintenanceController::class, 'destroy'])->name('destroy');
        });

        Route::get('/admin/profil', [App\Http\Controllers\Admin\AdminController::class, 'profile'])->name('admin.profil');
        Route::post('/admin/profil/update-password', [App\Http\Controllers\Admin\AdminController::class, 'updatePassword'])->name('admin.profil.updatePassword');
    });

    Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');
});



Route::delete('/booking/{id}', [BookingController::class, 'destroy'])->name('booking.destroy');

 Route::delete('/admin/booking/{id}', [BookingMasukController::class, 'destroy'])->name('admin.booking.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [UserController::class, 'showProfil'])->name('profil.show');
    Route::post('/profil/update', [UserController::class, 'updateProfil'])->name('profil.update');
    Route::get('/user-profil', [UserController::class, 'profil'])->name('user.profil');
});



Route::middleware('auth')->group(function () {
    Route::get('/booking-saya', [BookingSayaController::class, 'index'])->name('booking.index');
    Route::get('/booking/{id}', [BookingSayaController::class, 'show'])->name('booking.show');
    Route::delete('/booking/{id}', [BookingSayaController::class, 'destroy'])->name('booking.destroy'); // jika kamu sudah siapkan metode hapus
});




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/cek-jadwal-booking/{ruangId}/{tanggal}', [BookingController::class, 'cekJadwal']);

Route::get('/pendaftaran-saya', [BookingController::class, 'pendaftaranSaya'])->name('user.pendaftaran');


Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

Route::get('/ruangan', [RuangController::class, 'index'])->middleware('auth')->name('ruangan.index');

Route::post('/ruang', [RuanganController::class, 'store'])->name('ruang.store');
Route::resource('ruang', RuanganController::class);
Route::get('admin/ruangan', [RuanganController::class, 'index'])->name('admin.ruangan.index');


Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/admin/password/reset/{token}', [ResetPasswordController::class, 'showResetFormAdmin'])->name('admin.password.reset');
Route::post('/admin/password/reset', [ResetPasswordController::class, 'resetAdmin'])->name('admin.password.update');


Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home.user');
})->name('home.user');

Route::get('/admin', function () {
    return view('home.admin');
})->name('home.admin');


Route::get('/admin/profil', function () {
    return view('admin.profil');
})->name('admin.profil');