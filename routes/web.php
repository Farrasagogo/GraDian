<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Firebase\PenyiramanController;
use App\Http\Controllers\Firebase\RiwayatSensorSiram;
use App\Http\Controllers\Firebase\SensorController;
use App\Http\Controllers\Firebase\RiwayatSensorLdr;
use App\Http\Controllers\Firebase\PenyinaranController;
use App\Http\Controllers\Firebase\RiwayatPenyiraman;
use App\Http\Controllers\Firebase\RiwayatPenyinaran;
use App\Http\Controllers\Firebase\ObatController;
use App\Http\Controllers\Firebase\Penjadwalan;
use App\Http\Controllers\Firebase\RiwayatObat;
use App\Http\Controllers\Firebase\AuthController;
use App\Http\Controllers\Firebase\Akun;
use App\Http\Controllers\Firebase\LupaPassword;
use App\Http\Controllers\Firebase\UbahPassword;
use App\Http\Controllers\Firebase\Dashboard;

Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/password/forgot', [LupaPassword::class, 'showForgotPasswordForm'])->name('password.forgot');
Route::post('/password/forgot', [LupaPassword::class, 'sendResetLink'])->name('password.forgot.send');
Route::get('/password/reset', [UbahPassword::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [UbahPassword::class, 'resetPassword'])->name('password.update');
Route::post('/logout', [Akun::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
    Route::get('/profile', [Akun::class, 'show'])->name('profile');
Route::get('/profile/edit', [Akun::class, 'edit'])->name('profile.edit');
Route::get('/profile/update', [Akun::class, 'update'])->name('profile.update');
Route::post('/profile/update', [Akun::class, 'update'])->name('profile.update');
    Route::get('/Akun', [Akun::class, 'index'])->name('Akun');
    Route::post('jadwal/store', [Penjadwalan::class, 'store'])->name('store');
    Route::post('/jadwal/update/{id}', [Penjadwalan::class, 'update'])->name('jadwal.update');
    Route::get('jadwal/edit/{id}', [Penjadwalan::class, 'edit'  ])->name('edit');
    Route::delete('jadwal/delete/{id}', [Penjadwalan::class, 'destroy'])->name('delete');
    Route::get('/jadwal', [Penjadwalan::class, 'index'])->name('jadwal');
    Route::post('/updateobatauto', [ObatController::class, 'updateobatauto']);
    Route::get('riwayatobat', [RiwayatObat::class, 'index']);
    Route::patch('/update-firebaseobat2', [ObatController::class, 'updateFirebase2']);
    Route::patch('/update-firebaseobat', [ObatController::class, 'updateFirebase']);
    Route::get('/obat', [ObatController::class, 'index']);
    Route::get('/riwayatpenyinaran', [RiwayatPenyinaran::class, 'index']);
    Route::get('/riwayatpenyiraman', [RiwayatPenyiraman::class, 'index']);
    Route::patch('/update-firebase', [PenyiramanController::class, 'updateFirebaseSiram']);
    Route::get('riwayatldr', [RiwayatSensorLdr::class, 'index']);
    Route::get('riwayatsiram', [RiwayatSensorSiram::class, 'index']);
    Route::get('penyinaran', [PenyinaranController::class, 'index']);
    Route::get('/sensor-data', [SensorController::class, 'getSensorData']);
    Route::post('/updatesinarauto', [PenyinaranController::class, 'updatesinarauto']);
    Route::post('/updatesinar', [PenyinaranController::class, 'updatesinar']);
    Route::post('/updatesiramauto', [PenyiramanController::class, 'updatesiramauto']);
    Route::get('penyiraman', [PenyiramanController::class, 'index'])->name('penyiraman');
});


Route::get('/', function () {
    return view('welcome');
});
