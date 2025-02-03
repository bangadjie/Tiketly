<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\petugasController;
use App\Http\Controllers\pelangganController;
use App\Http\Controllers\keretaController;
use App\Http\Controllers\gerbongController;
use App\Http\Controllers\kursiController;
use App\Http\Controllers\jadwalController;
use Database\Seeders\pelanggan;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);

// Route::get('/petugas', [petugasController::class, 'index']);
// Route::post('/petugas', [petugasController::class, 'store']);
// Route::get('/petugas/{id}', [petugasController::class, 'show']);
// Route::put('/petugas/{id}', [petugasController::class, 'update']);
// Route::delete('/petugas/{id}', [petugasController::class, 'destroy']);

// Route::get('/pelanggan', [pelangganController::class, 'index']);
// Route::post('/pelanggan', [pelangganController::class, 'store']);
// Route::get('/pelanggan', [pelangganController::class, 'show']);
// Route::put('/pelanggan', [pelangganController::class, 'update']);
// Route::delete('/pelanggan', [pelangganController::class, 'destroy']);

// Route::get('/kereta', [keretaController::class, 'index']);
// Route::post('/kereta', [keretaController::class, 'store']);
// Route::get('/kereta', [keretaController::class, 'show']);
// Route::put('/kereta', [keretaController::class, 'update']);
// Route::delete('/kereta', [keretaController::class, 'destroy']);

// Route::get('/gerbong', [gerbongController::class, 'index']);
// Route::post('/gerbong', [gerbongController::class, 'store']);
// Route::get('/gerbong/{id}', [gerbongController::class, 'show']);
// Route::put('/gerbong/{id}', [gerbongController::class, 'update']);
// Route::delete('/gerbong/{id}', [gerbongController::class, 'destroy']);

// Route::get('/kursi', [kursiController::class, 'index']);
// Route::post('/kursi', [kursiController::class, 'store']);
// Route::get('/kursi', [kursiController::class, 'show']);
// Route::put('/kursi', [kursiController::class, 'update']);
// Route::delete('/kursi', [kursiController::class, 'destroy']);

// Route::get('/jadwal', [jadwalController::class, 'index']);
// Route::post('/jadwal', [jadwalController::class, 'store']);
// Route::get('/jadwal', [jadwalController::class, 'show']);
// Route::put('/jadwal', [jadwalController::class, 'update']);
// Route::delete('/jadwal', [jadwalController::class, 'destroy']);
