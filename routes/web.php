<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LmsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

// --- HALAMAN UTAMA & PUBLIK ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [HomeController::class, 'profile'])->name('profil');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita.index');
Route::get('/berita/{slug}', [HomeController::class, 'showBerita'])->name('berita.show');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');

// --- LMS LIGHT PUBLIK ---
Route::get('/lms', [LmsController::class, 'index'])->name('lms.index');
Route::post('/lms/assignment/{id}/submit', [LmsController::class, 'submitAssignment'])->name('lms.submit');

// --- AUTENTIKASI ---
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- TIKET & LACAK STATUS PUBLIK ---
Route::get('/lacak', [TicketController::class, 'track'])->name('ticket.track');
Route::get('/resi/{ticket_code}', [TicketController::class, 'downloadReceipt'])->name('ticket.receipt');

// --- LAYANAN DIGITAL PUBLIK ---
Route::prefix('layanan')->name('services.')->group(function () {
    // Cek status resi tiket (URL: /layanan/cek)
    Route::get('/cek', [ServiceController::class, 'checkStatus'])->name('check');
    Route::post('/cek', [ServiceController::class, 'searchStatus'])->name('search');

    // PPDB
    Route::get('/ppdb', [ServiceController::class, 'formPpdb'])->name('ppdb');
    Route::post('/ppdb', [ServiceController::class, 'storePpdb'])->name('ppdb.store');

    // Surat TU
    Route::get('/surat', [ServiceController::class, 'formSurat'])->name('surat');
    Route::post('/surat', [ServiceController::class, 'storeSurat'])->name('surat.store');

    // Pengaduan
    Route::get('/pengaduan', [ServiceController::class, 'formPengaduan'])->name('pengaduan');
    Route::post('/pengaduan', [ServiceController::class, 'storePengaduan'])->name('pengaduan.store');

    // Jadwal Temu
    Route::get('/jadwal-temu', [ServiceController::class, 'formJadwalTemu'])->name('jtm');
    Route::post('/jadwal-temu', [ServiceController::class, 'storeJadwalTemu'])->name('jtm.store');

    // Store umum (fallback)
    Route::post('/', [ServiceController::class, 'store'])->name('store');
});

// --- DASHBOARD MULTI-ROLE & MANAJEMEN (PROTECTED AUTH) ---
Route::middleware(['auth'])->group(function () {

    // Super Admin Dashboard & Manajemen Pengguna
    Route::middleware('role:super_admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard');

        // Manajemen Pengguna (CRUD User)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Kepala Sekolah Dashboard
    Route::middleware('role:kepala_sekolah')->prefix('kepala')->name('kepala.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'kepalaIndex'])->name('dashboard');
    });

    // Guru Dashboard, LMS Post, Tugas, & Penilaian
    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'guruIndex'])->name('dashboard');
        Route::post('/lms/materi', [LmsController::class, 'storeCourse'])->name('lms.store');
        Route::post('/lms/tugas', [LmsController::class, 'storeAssignment'])->name('assignment.store');
        Route::post('/submission/{id}/grade', [LmsController::class, 'gradeAssignment'])->name('submission.grade');
    });

    // Staf TU Dashboard & Tiket Update
    Route::middleware('role:staf_tu')->prefix('tu')->name('tu.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'tuIndex'])->name('dashboard');
        Route::put('/ticket/{id}/update', [DashboardController::class, 'updateTicketStatus'])->name('ticket.update');
    });

    // Ekspor Data Rekap (Excel & PDF)
    Route::get('/export/excel', [DashboardController::class, 'exportExcel'])->name('dashboard.export.excel');
    Route::get('/export/pdf', [DashboardController::class, 'exportPdf'])->name('dashboard.export.pdf');
});
