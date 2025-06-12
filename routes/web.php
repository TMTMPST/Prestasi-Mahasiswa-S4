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
use App\Http\Controllers\RecommendationController;

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

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard routes
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard'])->middleware('checklogin')->name('mahasiswa.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('checklogin')->name('admin.dashboard');
Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->middleware('checklogin')->name('dosen.dashboard');

    // Admin routes
        Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile.index');
        Route::put('/admin/profile/update/{id}', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
        Route::get('/admin/profile/update_profile/{id}', [AdminController::class, 'showUpdateProfile'])->name('admin.profile.update_profile');

        // Manajemen Pengguna
        Route::group(['prefix' => 'manajemen-user'], function () {
            Route::get('/', [AdminController::class, 'showPengguna'])->name('admin.pengguna.index');
            Route::get('/tambah', [AdminController::class, 'createPengguna'])->name('admin.pengguna.create');
            Route::post('/store', [AdminController::class, 'storePengguna'])->name('admin.pengguna.store');
            Route::get('/edit/{id}', [AdminController::class, 'editPengguna'])->name('admin.pengguna.edit');
            Route::put('/update/{id}', [AdminController::class, 'updatePengguna'])->name('admin.pengguna.update');
            Route::delete('/delete/{id}', [AdminController::class, 'deletePengguna'])->name('admin.pengguna.delete');
        });

        // Manajemen Lomba
        Route::group(['prefix' => 'manajemen-lomba'], function () {
            Route::get('/', [AdminController::class, 'showLomba'])->name('admin.lomba.index');
            Route::get('/create', [AdminController::class, 'createLomba'])->name('admin.lomba.create');
            Route::post('/store', [AdminController::class, 'storeLomba'])->name('admin.lomba.store');
            Route::get('/edit/{id}', [AdminController::class, 'editLomba'])->name('admin.lomba.edit');
            Route::put('/update/{id}', [AdminController::class, 'updateLomba'])->name('admin.lomba.update');
            Route::put('/update-status/{id}', [AdminController::class, 'updateStatusLomba'])->name('admin.lomba.update_status');
            Route::delete('/delete/{id}', [AdminController::class, 'deleteLomba'])->name('admin.lomba.delete');
        });

        // Manajemen Presma
        Route::group(['prefix' => 'manajemen-presma'], function () {
            Route::get('/', [AdminController::class, 'showPresma'])->name('admin.presma.index');
            Route::get('/create', [AdminController::class, 'createPresma'])->name('admin.presma.create');
            Route::post('/store', [AdminController::class, 'storePresma'])->name('admin.presma.store');
            Route::get('/edit/{id}', [AdminController::class, 'editPresma'])->name('admin.presma.edit');
            Route::put('/update/{id}', [AdminController::class, 'updatePresma'])->name('admin.presma.update');
            Route::delete('/delete/{id}', [AdminController::class, 'deletePresma'])->name('admin.presma.delete');
        });
        
        Route::group(['prefix' => 'manajemen-verifikasi'], function () {
            Route::get('/', [AdminController::class, 'showVerifikasi'])->name('admin.verifikasi.index');
            Route::put('/{id}/update', [AdminController::class, 'updateVerifikasi'])->name('admin.verifikasi.update');
        });

    // Dosen routes
        Route::get('/dashboard/lomba/{id}/detail', [App\Http\Controllers\DosenController::class, 'showLomba'])->name('dosen.dashboard.lomba.show');
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
        Route::post('/bimbingan/{nim}/accept', [\App\Http\Controllers\DosenController::class, 'acceptBimbingan'])->name('bimbingan.accept');
        Route::post('/bimbingan/{nim}/reject', [\App\Http\Controllers\DosenController::class, 'rejectBimbingan'])->name('bimbingan.reject');

        Route::get('/dosen/profile', [DosenController::class, 'profile'])->name('dosen.profile.index');
        Route::put('/dosen/profile/update/{nip}', [DosenController::class, 'updateProfileAction'])->name('dosen.profile.update');        
        Route::get('/dosen/profile/update_profile/{nip}', [DosenController::class, 'showUpdateProfile'])->name('dosen.profile.update_profile');



    // Mahasiswa Routes
        // prestasi
        Route::get('/prestasi/index', [MahasiswaController::class, 'prestasi'])->name('mahasiswa.prestasi.index');
        Route::get('/prestasi/tambah_prestasi', [MahasiswaController::class, 'create_prestasi'])->name('mahasiswa.prestasi.tambah_prestasi');
        Route::post('/prestasi', [MahasiswaController::class, 'store_prestasi'])->name('mahasiswa.store_prestasi');
        Route::get('/prestasi/{id}/edit', [MahasiswaController::class, 'edit_prestasi'])->name('mahasiswa.edit_prestasi');
        Route::put('/prestasi/{id}', [MahasiswaController::class, 'update_prestasi'])->name('mahasiswa.update_prestasi');
        Route::delete('/prestasi/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

        // bimbingan
        Route::get('/bimbingan/index', [MahasiswaController::class, 'bimbingan'])->name('mahasiswa.bimbingan.index');
        Route::get('/bimbingan/tambah_bimbingan', [MahasiswaController::class, 'create_bimbingan'])->name('mahasiswa.bimbingan.tambah_bimbingan');
        Route::post('/bimbingan', [MahasiswaController::class, 'store_bimbingan'])->name('mahasiswa.store_bimbingan');
        Route::get('/bimbingan/{id}/edit', [MahasiswaController::class, 'edit_bimbingan'])->name('mahasiswa.edit_bimbingan');
        Route::put('/bimbingan/{id}', [MahasiswaController::class, 'update_bimbingan'])->name('mahasiswa.update_bimbingan');
        Route::delete('/bimbingan/{id}', [MahasiswaController::class, 'destroy_bimbingan'])->name('mahasiswa.destroy_bimbingan');

        // Verifikasi
        Route::get('/verifikasi/index', [MahasiswaController::class, 'verifikasi'])->name('mahasiswa.verifikasi.index');

        // Statistik
        Route::get('/statistik', [\App\Http\Controllers\StatistikController::class, 'index'])->name('mahasiswa.statistik.index');
        Route::get('/statistik/chart-data', [\App\Http\Controllers\StatistikController::class, 'getChartData'])->name('mahasiswa.statistik.chart-data');

        // Recommendation
        Route::get('/recommendation/form', [RecommendationController::class, 'showForm'])->name('mahasiswa.recomendation.form');
        Route::post('/recommendation/step1', [RecommendationController::class, 'processStep1'])->name('mahasiswa.recomendation.step1');
        Route::get('/recommendation/criteria', [RecommendationController::class, 'showCriteria'])->name('mahasiswa.recomendation.criteria');
        Route::post('/recommendation/process', [RecommendationController::class, 'processForm'])->name('mahasiswa.recomendation.process');
        Route::get('/recommendation/result', [RecommendationController::class, 'showResult'])->name('mahasiswa.recomendation.result');
        Route::get('/recommendation/trace', [RecommendationController::class, 'showTrace'])->name('mahasiswa.recomendation.trace');

        // profile
        Route::get('/profile/index', [MahasiswaController::class, 'profile'])->name('mahasiswa.profile.index');
        Route::get('/profile/update_profile/{nim}', [MahasiswaController::class, 'showUpdateProfile'])->name('mahasiswa.profile.update_profile');
        Route::put('/profile/update_profile/{nim}', [MahasiswaController::class, 'updateProfileAction'])->name('mahasiswa.profile.update_profile');

    // Dosen Routes
        // Dashboard
        Route::get('/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
        
        // Bimbingan
        Route::get('/bimbingan', [DosenController::class, 'Bimbingan'])->name('dosen.bimbingan.index');
        Route::post('/bimbingan/accept/{nim}', [DosenController::class, 'acceptBimbingan'])->name('dosen.acceptBimbingan');
        Route::delete('/bimbingan/reject/{nim}', [DosenController::class, 'rejectBimbingan'])->name('dosen.rejectBimbingan');
        Route::get('/bimbingan/prestasi/{nim}', [DosenController::class, 'showPrestasiMhs'])->name('dosen.showPrestasiMhs');

        // Lomba
        Route::get('/lomba', [DosenController::class, 'infoLomba'])->name('dosen.lomba.index');
        Route::get('/lomba/create', [DosenController::class, 'CreateInfoLomba'])->name('dosen.lomba.create');
        Route::post('/lomba', [DosenController::class, 'storeInfoLomba'])->name('dosen.lomba.store');
        Route::get('/lomba/{id}', [DosenController::class, 'showLomba'])->name('dosen.lomba.show');

        // Presma
        Route::get('/presma', [DosenController::class, 'Presma'])->name('dosen.presma.index');

        // Profile
        Route::get('/profile', [DosenController::class, 'profile'])->name('dosen.profile.index');
        Route::get('/profile/{nip}/edit', [DosenController::class, 'showUpdateProfile'])->name('dosen.profile.edit');
        Route::put('/profile/{nip}', [DosenController::class, 'updateProfileAction'])->name('dosen.profile.update');
