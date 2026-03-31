<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Livewire\MonitorAntrian;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| 1. HALAMAN PUBLIK (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/

// Halaman Utama (Landing Page)
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Halaman Monitor TV (Livewire)
Route::get('/monitor', MonitorAntrian::class)->name('monitor');

// Halaman Kiosk / Ambil Antrian
Route::get('/daftar', [AntrianController::class, 'index'])->name('antrian.index');
Route::post('/daftar', [AntrianController::class, 'store'])->name('antrian.daftar');

/*
|--------------------------------------------------------------------------
| 2. AUTENTIKASI (Login, Register, Logout)
|--------------------------------------------------------------------------
*/

// Form Login & Proses Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.proses');

// Proses Register (Daftar Akun Petugas Baru)
Route::post('/register', [LoginController::class, 'register'])->name('register.proses');

// Proses Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| 3. HALAMAN ADMIN (Harus Login)
|--------------------------------------------------------------------------
*/

// Semua route di dalam grup ini otomatis:
// 1. Memiliki prefix URL '/admin' (contoh: /admin/dokter)
// 2. Memiliki prefix Nama 'admin.' (contoh: route('admin.dokter.index'))
// 3. Wajib Login (middleware auth)

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Admin
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Tombol Aksi Antrian (Panggil, Selesai, Lewati/Batal)
    Route::post('/panggil/{id}', [AdminController::class, 'panggil'])->name('panggil');
    Route::post('/selesai/{id}', [AdminController::class, 'selesai'])->name('selesai');
    Route::post('/lewati/{id}', [AdminController::class, 'lewati'])->name('lewati');

    // Manajemen Dokter (CRUD)
    // URL: /admin/dokter
    Route::resource('dokter', DokterController::class);

    // Manajemen Poli (Hanya Edit Estimasi & Status)
    // URL: /admin/poli
    Route::resource('poli', PoliController::class)->only(['index', 'update']);

    // Laporan Kunjungan (Harian/Detail)
    // URL: /admin/laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');

    // Rekap Data (Mungkin untuk export atau rekap bulanan)
    // URL: /admin/rekap
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap');
});