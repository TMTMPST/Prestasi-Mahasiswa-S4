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
Route::get('/admin/dashboard', fn() => view('admin.dashboard'))->middleware('checklogin')->name('admin.dashboard');
Route::get('/mahasiswa/dashboard', fn() => view('mahasiswa.dashboard'))->middleware('checklogin')->name('mahasiswa.dashboard');



//Dosen routes

    // Dosen routes
    Route::middleware(['web', 'checklogin'])->group(function () {
        Route::get('/dosen/dashboard', [DosenController::class, 'dashboard'])->name('dosen.dashboard');
        Route::get('/dosen/Lomba/index', [DosenController::class, 'infoLomba'])->name('dosen.lomba.index');
        Route::get('/dosen/Lomba/{id}/detail', [DosenController::class, 'showLomba'])->name('dosen.lomba.show');
        Route::get('/dosen/Lomba/{id}/daftar', [DosenController::class, 'daftarLomba'])->name('dosen.lomba.daftar');

        Route::get('/dosen/DosPem/index', [DosenController::class, 'DosenPembimbing'])->name('dosen.DosPem.index');
    });
