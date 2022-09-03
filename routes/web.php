<?php

use App\Http\Controllers\AntrianController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PoliController;

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

Route::get('/', [HomeController::class, 'clientAntrian'])->name('antrian');
Route::get('/status', fn () => view('pendaftaran.status'))->name('pendaftaran.status');
Route::get('/acount', fn () => view('petugas.acount'))->name('petugas.acount');

Route::prefix('pendaftaran')->group(function () {
    Route::get('/baru', [PendaftaranController::class, 'pasienBaruView'])->name('pendaftaran.baru');
    Route::get('/lama', [PendaftaranController::class, 'pasienLamaView'])->name('pendaftaran.lama');
    Route::post('/riwayat', [PendaftaranController::class, 'riwayatPasienLama'])->name('pendaftaran.riwayat');
    Route::post('/lama', [PendaftaranController::class, 'cariPasienLama'])->name('pendaftaran.cari');
    Route::post('/daftar', [PendaftaranController::class, 'daftarAntrian'])->name('pendaftaran.save');
    Route::get('/selesai', [PendaftaranController::class, 'pendaftaranSelesai'])->name('pendaftaran.selesai');
});



Route::prefix('account')->group(function () {
    Route::get('/profil', [AuthController::class, 'profileView'])->middleware(['auth'])->name('user.profil.view');
    Route::post('/profil', [AuthController::class, 'updateProfil'])->middleware(['auth'])->name('user.profil.update');
    Route::get('/login', [AuthController::class, 'loginView'])->middleware('guest')->name('user.login.view');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login.auth');
    Route::get('/register', [AuthController::class, 'registerView'])->middleware('guest')->name('user.register.view');
    Route::post('/register', [AuthController::class, 'register'])->name('user.register.create');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('dashboard.index');
});

Route::prefix('poli')->middleware(['auth'])->group(function () {
    Route::get('/', [PoliController::class, 'index'])->name('poli.index');
    Route::get('/create', [PoliController::class, 'createView'])->name('poli.create.view');
    Route::post('/create', [PoliController::class, 'savePoliklinik'])->name('poli.create.save');
    Route::get('/{id}/edit', [PoliController::class, 'editView'])->name('poli.edit.view');
    Route::post('/{id}/edit', [PoliController::class, 'editSave'])->name('poli.edit.save');
    Route::delete('/delete/{id}', [PoliController::class, 'delete'])->name('poli.delete');
});

Route::prefix('jadwal')->middleware(['auth'])->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/create', [JadwalController::class, 'createView'])->name('jadwal.create.view');
    Route::post('/create', [JadwalController::class, 'saveJadwalDokter'])->name('jadwal.create.save');
    Route::get('/{id}/edit', [JadwalController::class, 'editView'])->name('jadwal.edit.view');
    Route::post('/{id}/edit', [JadwalController::class, 'editSave'])->name('jadwal.edit.save');
    Route::delete('/delete/{id}', [JadwalController::class, 'delete'])->name('jadwal.delete');
});

Route::prefix('pasien')->middleware(['auth'])->group(function () {
    Route::get('/', [PasienController::class, 'index'])->name('pasien.index');
});

Route::prefix('antrian')->middleware(['auth'])->group(function () {
    Route::get('/', [AntrianController::class, 'index'])->name('antrian.index');
    Route::post('/hadir/{id}', [AntrianController::class, 'hadir'])->name('antrian.hadir');
    Route::post('/tidakhadir/{id}', [AntrianController::class, 'tidakHadir'])->name('antrian.tidakhadir');
});
