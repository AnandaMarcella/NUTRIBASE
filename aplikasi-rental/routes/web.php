<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PemesananAdminController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LaporanController;

// Landing Page
Route::get('/', fn() => view('landing'))->name('landing');
Route::get('/tentang', fn() => view('landing_tentang'))->name('tentang');
Route::get('/kontak', fn() => view('landing_kontak'))->name('kontak');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---- ADMIN ----
    Route::middleware('can:admin')->group(function () {
        // Kelola Mobil
        Route::get('/mobil',              [MobilController::class, 'index'])->name('mobil.index');
        Route::get('/mobil/create',       [MobilController::class, 'create'])->name('mobil.create');
        Route::post('/mobil',             [MobilController::class, 'store'])->name('mobil.store');
        Route::get('/mobil/{id}/edit',    [MobilController::class, 'edit'])->name('mobil.edit');
        Route::put('/mobil/{id}',         [MobilController::class, 'update'])->name('mobil.update');
        Route::delete('/mobil/{id}',      [MobilController::class, 'destroy'])->name('mobil.destroy');
        Route::get('/mobil/print',        [MobilController::class, 'print'])->name('mobil.print');
        // Kelola User
        Route::get('/user',               [UserController::class, 'index'])->name('user.index');
        Route::post('/user',              [UserController::class, 'store'])->name('user.store');
        Route::delete('/user/{id}',       [UserController::class, 'destroy'])->name('user.destroy');
        // Kelola Pemesanan
        Route::get('/admin/pemesanan',          [PemesananAdminController::class, 'index'])->name('admin.pemesanan.index');
        Route::patch('/admin/pemesanan/{id}/status', [PemesananAdminController::class, 'updateStatus'])->name('admin.pemesanan.status');
        Route::post('/admin/pembayaran/{id}/konfirmasi', [PemesananAdminController::class, 'konfirmasiBayar'])->name('admin.pembayaran.konfirmasi');
        // Feedback
        Route::get('/feedback/kelola',    [FeedbackController::class, 'adminIndex'])->name('feedback.admin');
        Route::post('/feedback/{id}/balas',[FeedbackController::class, 'balas'])->name('feedback.balas');
    });

    // ---- OWNER ----
    Route::middleware('can:owner')->group(function () {
        Route::get('/laporan',             [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/feedback/owner',      [FeedbackController::class, 'adminIndex'])->name('feedback.owner');
        Route::post('/feedback/{id}/balas-owner', [FeedbackController::class, 'balas'])->name('feedback.balas.owner');
    });

    // ---- CUSTOMER ----
    Route::middleware('can:customer')->group(function () {
        Route::get('/pesan',              [PemesananController::class, 'index'])->name('pesan.index');
        Route::post('/pesan',             [PemesananController::class, 'store'])->name('pesan.store');
        Route::get('/pembayaran',         [PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::get('/pembayaran/{id}',    [PembayaranController::class, 'show'])->name('pembayaran.detail');
        Route::post('/pembayaran/{id}/konfirmasi',[PembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');
        Route::get('/histori',            [HistoriController::class, 'index'])->name('histori.index');
        Route::get('/feedback',           [FeedbackController::class, 'index'])->name('feedback.index');
        Route::post('/feedback',          [FeedbackController::class, 'store'])->name('feedback.store');
    });
});
