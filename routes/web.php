<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PrometheeController;

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

// Show the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Show login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle login form POST submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::post('/logout', function () {
    Session::flush(); // remove all session data
    return redirect('/login')->with('success', 'Logout successful.');
})->name('logout');

// Dashboard routes
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->middleware('checklogin')->name('mahasiswa.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('checklogin')->name('admin.dashboard');
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->middleware('checklogin')->name('dosen.dashboard');

    // Admin routes
        Route::get('/manajemen-user', [AdminController::class, 'showPengguna'])->name('admin.pengguna.index');
        Route::get('/manajemen-user/tambah', [AdminController::class, 'createPengguna'])->name('admin.pengguna.create');
        Route::post('/manajemen-user/store', [AdminController::class, 'storePengguna'])->name('admin.pengguna.store');
        Route::get('/manajemen-user/edit/{id}', [AdminController::class, 'editPengguna'])->name('admin.pengguna.edit');
        Route::put('/manajemen-user/update/{id}', [AdminController::class, 'updatePengguna'])->name('admin.pengguna.update');
        Route::delete('/manajemen-user/delete/{id}', [AdminController::class, 'deletePengguna'])->name('admin.pengguna.delete');

    // Dosen routes
        Route::get('/Lomba/index', [DosenController::class, 'infoLomba'])->name('dosen.lomba.index');
        Route::get('/lomba', [DosenController::class, 'infoLomba'])->name('lomba.index');
        Route::get('/Lomba/{id}/detail', [DosenController::class, 'showLomba'])->name('dosen.lomba.show');
        Route::get('/Lomba/{id}/daftar', [DosenController::class, 'daftarLomba'])->name('dosen.lomba.daftar');
        Route::get('/Lomba/create', [DosenController::class, 'CreateInfoLomba'])->name('lomba.create');
        Route::post('/Lomba/store', [DosenController::class, 'storeInfoLomba'])->name('lomba.store');

        Route::get('/Presma/index', [DosenController::class, 'Presma'])->name('dosen.presma.index');
        
        Route::get('Bimbingan/index', [DosenController::class, 'Bimbingan'])->name('dosen.bimbingan.index');
        Route::get('/dosen/bimbingan/{nim}/prestasi', [DosenController::class, 'showPrestasiMhs'])->name('dosen.bimbingan.prestasi');
        Route::get('/dosen/bimbingan', [DosenController::class, 'Bimbingan'])->name('dosen.bimbingan');
        
        Route::get('/dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile.index');
Route::put('/dosen/profile/update/{nip}', [DosenController::class, 'updateProfileAction'])->name('dosen.profile.update');        
Route::get('/dosen/profile/update_profile/{nip}', [DosenController::class, 'showUpdateProfile'])->name('dosen.profile.update_profile');
    // Mahasiswa Routes
        // prestasi
        Route::get('/prestasi/index', [MahasiswaController::class, 'prestasi'])->name('mahasiswa.prestasi.index');
        Route::get('/prestasi/tambah_prestasi', [MahasiswaController::class, 'create_prestasi'])->name('mahasiswa.prestasi.tambah_prestasi');

        // bimbingan
        Route::get('/bimbingan/index', [MahasiswaController::class, 'bimbingan'])->name('mahasiswa.bimbingan.index');
        Route::get('/bimbingan/tambah_bimbingan', [MahasiswaController::class, 'create_bimbingan'])->name('mahasiswa.bimbingan.tambah_bimbingan');

        // Verifikasi
        Route::get('/verifikasi/index', [MahasiswaController::class, 'verifikasi'])->name('mahasiswa.verifikasi.index');