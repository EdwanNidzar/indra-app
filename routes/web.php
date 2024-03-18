<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaAktifController;
use App\Http\Controllers\PenelitianController;
use App\Http\Controllers\PKLController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\SuratKeluar;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');

});

Route::get('/dashboard', function () {
    return view('utama');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
    Routes mahasiswaaktif
*/
Route::resource('mahasiswaaktif', MahasiswaAktifController::class)->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::patch('/mahasiswaaktif/{mahasiswaaktif}/approve', [MahasiswaAktifController::class, 'approve'])->name('mahasiswaaktif.approve')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::patch('/mahasiswaaktif/{mahasiswaaktif}/reject', [MahasiswaAktifController::class, 'reject'])->name('mahasiswaaktif.reject')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::get('/mahasiswaaktif/{mahasiswaaktif}/cetak', [MahasiswaAktifController::class, 'cetak'])->name('mahasiswaaktif.cetak')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);

/*
    Routes penelitian
*/
Route::resource('penelitian', PenelitianController::class)->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::patch('/penelitian/{penelitian}/approve', [PenelitianController::class, 'approve'])->name('penelitian.approve')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::patch('/penelitian/{penelitian}/reject', [PenelitianController::class, 'reject'])->name('penelitian.reject')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::get('/penelitian/{penelitian}/cetak', [PenelitianController::class, 'cetak'])->name('penelitian.cetak')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);

/*
    Routes pkl
*/
Route::resource('pkl', PKLController::class)->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::patch('/pkl/{pkl}/approve', [PKLController::class, 'approve'])->name('pkl.approve')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::patch('/pkl/{pkl}/reject', [PKLController::class, 'reject'])->name('pkl.reject')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);
Route::get('/pkl/{pkl}/cetak', [PKLController::class, 'cetak'])->name('pkl.cetak')->middleware(['auth', 'verified', 'role:mahasiswa|karyawan-admin|karyawan-operator']);

/*
    Routes cuti
*/
Route::resource('cuti', CutiController::class)->middleware(['auth', 'verified', 'role:dosen|dosen-yayasan|dosen-pns|karyawan-admin|karyawan-operator']);
Route::patch('/cuti/{cuti}/approve', [CutiController::class, 'approve'])->name('cuti.approve')->middleware(['auth', 'verified', 'role:dosen|dosen-yayasan|dosen-pns|karyawan-admin|karyawan-operator']);
Route::patch('/cuti/{cuti}/reject', [CutiController::class, 'reject'])->name('cuti.reject')->middleware(['auth', 'verified', 'role:dosen|dosen-yayasan|dosen-pns|karyawan-admin|karyawan-operator']);
Route::get('/cuti/{cuti}/cetak', [CutiController::class, 'cetak'])->name('cuti.cetak')->middleware(['auth', 'verified', 'role:dosen|dosen-yayasan|dosen-pns|karyawan-admin|karyawan-operator']);

/*
    Routes cuti
*/
Route::get('/suratkeluar/cetak', [SuratKeluar::class, 'cetak'])->name('suratkeluar.cetak');

require __DIR__ . '/auth.php';
