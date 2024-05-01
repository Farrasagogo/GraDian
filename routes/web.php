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

Route::post('/jadwal/store', [Penjadwalan::class, 'store'])->name('store');
Route::put('jadwal/update/{id}', [Penjadwalan::class, 'update'])->name('update');
Route::get('jadwal/edit/{id}', [Penjadwalan::class, 'edit'])->name('edit');
Route::delete('jadwal/delete/{id}', [Penjadwalan::class, 'destroy'])->name('delete');
Route::get('/jadwal', [Penjadwalan::class, 'index'])->name('jadwal');
Route::post('/updateobatauto', [ObatController::class, 'updateobatauto']);
Route::get('riwayatobat', [RiwayatObat::class, 'index']);
Route::patch('/update-firebaseobat2', [ObatController::class, 'updateFirebase2']);
Route::patch('/update-firebaseobat', [ObatController::class, 'updateFirebase']);
Route::get('/obat', [ObatController::class, 'index']);
Route::get('/riwayatpenyinaran', [RiwayatPenyinaran::class, 'index']);
Route::get('/riwayatpenyiraman', [RiwayatPenyiraman::class, 'index']);
Route::patch('/update-firebase', [PenyiramanController::class, 'updateFirebase']);
Route::get('riwayatldr', [RiwayatSensorLdr::class, 'index']);
Route::get('riwayatsiram', [RiwayatSensorSiram::class, 'index']);
Route::get('penyiraman', [PenyiramanController::class, 'index']);
Route::get('penyinaran', [PenyinaranController::class, 'index']);
Route::get('/sensor-data', [SensorController::class, 'getSensorData']);
Route::post('/updatesinarauto', [PenyinaranController::class, 'updatesinarauto']);
Route::post('/updatesinar', [PenyinaranController::class, 'updatesinar']);
Route::post('/updatesiramauto', [PenyiramanController::class, 'updatesiramauto']);
Route::get('/token', function (Request $request) {
    $token = $request->session()->token();
 
    $token = csrf_token();

});
Route::get('/', function () {
    return view('welcome');
});
