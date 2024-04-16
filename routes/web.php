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
 
    // ...
});
Route::get('/', function () {
    return view('welcome');
});
