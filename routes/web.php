<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home.user');
})->name('home.user');

Route::get('/admin', function () {
    return view('home.admin');
})->name('home.admin');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/dashboard', function () {
    return view('dashboard.user');
})->name('dashboard.user');

Route::get('/ruangan', function () {
    return view('ruangan.index');
})->name('ruangan.index');

Route::get('/booking/{id}', function ($id) {
    return view('booking.create'); // nanti bisa pakai $id untuk tampilkan nama ruang
})->name('booking.create');

Route::get('/booking', function () {
    return view('booking.index');
})->name('booking.index');

Route::get('/booking/detail/{id}', function ($id) {
    return view('booking.show');
})->name('booking.show');

Route::get('/profil', function () {
    return view('user.profil');
})->name('user.profil');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/ruangan', function () {
    return view('admin.ruangan.index');
})->name('admin.ruangan.index');

Route::get('/admin/booking', function () {
    return view('admin.booking.index');
})->name('admin.booking.index');

Route::get('/admin/maintenance', function () {
    return view('admin.maintenance.index');
})->name('admin.maintenance.index');

Route::get('/admin/profil', function () {
    return view('admin.profil');
})->name('admin.profil');