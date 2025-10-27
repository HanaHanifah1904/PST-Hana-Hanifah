<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_Login;;
use App\Http\Controllers\C_Halaman;
use App\Http\Controllers\C_Home;
use App\Http\Controllers\C_Profile;
use App\Http\Controllers\C_Dokumentasi;
use App\Http\Controllers\C_Portofolio;
use App\Http\Controllers\C_TentangKami;


/*
|--------------------------------------------------------------------------
| Tampilan Umum
|--------------------------------------------------------------------------
*/
Route::view('/index', 'v_index');
Route::view('/admin', 'layout/v_template');

Route::get('/', [C_Halaman::class, 'index']);
Route::get('/halaman', [C_Halaman::class, 'index'])->name('v_halaman');

/*
|--------------------------------------------------------------------------
| Auth (Login & Register)
|--------------------------------------------------------------------------
*/
Route::get('/login', [C_Login::class, 'showLogin'])->name('login');
Route::post('/login', [C_Login::class, 'login'])->name('login');
Route::get('/register', [C_Login::class, 'showRegister'])->name('register');
Route::post('/register', [C_Login::class, 'register'])->name('register.post');
Route::post('/logout', [C_Login::class, 'logout'])->name('logout');
Route::get('/home', [C_Home::class, 'index'])->name('home');


Route::get('/profile', [C_Profile::class, 'index'])->name('v_profile');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [C_Profile::class, 'index'])->name('dashboard');
});

Route::put('/dashboard', [C_Profile::class, 'update'])->name('dashboard.update');
Route::get('/dashboard/profile/edit', [C_Profile::class, 'edit'])->name('dashboard.edit');

Route::get('/forgot-password', function() {
    return view('v_forgot-password'); // nanti buat view ini
})->name('password.request');

Route::post('/forgot-password', [C_Login::class, 'sendResetLink'])->name('password.email');
Route::get('/register', [C_Login::class, 'showRegister'])->name('register'); // menampilkan form register
Route::post('/register', [C_Login::class, 'register'])->name('register.post');

Route::get('/forgot-password', [C_Login::class, 'showForgotForm'])->name('password.request');
Route::post('/forgot-password', [C_Login::class, 'sendResetLink'])->name('password.email');

// Form reset password
Route::get('/reset-password/{token}', [C_Login::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [C_Login::class, 'resetPassword'])->name('password.update');

Route::get('/profile', [C_Profile::class, 'index'])->name('profile');
Route::put('/profile/update', [C_Profile::class, 'update'])->name('profile.update');

// Dokumentasi
// Admin
Route::get('/admin/dokumentasi', [C_Dokumentasi::class, 'index'])->name('dokumentasi.index');
Route::post('/dokumentasi/store', [C_Dokumentasi::class, 'store'])->name('dokumentasi.store');
Route::delete('/admin/dokumentasi/{id}', [C_Dokumentasi::class, 'destroy'])->name('dokumentasi.destroy');
Route::get('/dokumentasi/{id}/edit', [C_Dokumentasi::class, 'edit'])->name('dokumentasi.edit');
Route::resource('dokumentasi', C_Dokumentasi::class);

// Public
Route::get('/dokumentasi', [C_Dokumentasi::class, 'publicView'])->name('dokumentasi.public');
// Atau untuk halaman khusus
Route::get('/halaman', [C_Dokumentasi::class, 'publicView'])->name('halaman.public');

Route::get('/admin/portofolio', [C_Portofolio::class, 'index'])->name('portofolio.index');
Route::post('/admin/portofolio/store', [C_Portofolio::class, 'store'])->name('portofolio.store');
Route::delete('/admin/portofolio/delete/{id}', [C_Portofolio::class, 'destroy'])->name('portofolio.destroy');
Route::get('/portofolio/{id}/edit', [C_Portofolio::class, 'edit'])->name('portofolio.edit');
Route::put('/portofolio/{id}', [C_Portofolio::class, 'update'])->name('portofolio.update');
Route::get('/portofolio/{id}', [C_Portofolio::class, 'detail'])->name('portofolio.detail');

Route::get('/tentangkami', [C_TentangKami::class, 'index'])->name('tentangkami.index');
Route::post('/tentangkami/store', [C_TentangKami::class, 'store'])->name('tentangkami.store');
Route::get('/tentangkami/edit/{id}', [C_TentangKami::class, 'edit'])->name('tentangkami.edit');
Route::put('/tentangkami/update/{id}', [C_TentangKami::class, 'update'])->name('tentangkami.update');
Route::delete('/tentangkami/destroy/{id}', [C_TentangKami::class, 'destroy'])->name('tentangkami.destroy');
Route::get('/', [C_Halaman::class, 'index'])->name('halaman');