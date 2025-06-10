<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\petugasController;
use App\Http\Controllers\api\pelangganController;
use App\Http\Controllers\api\keretaController;
use App\Http\Controllers\api\gerbongController;
use App\Http\Controllers\api\kursiController;
use App\Http\Controllers\api\jadwalController;
use Database\Seeders\pelanggan;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, "index"]);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/test', [UserController::class, 'test']);

Route::get('/petugas', [PetugasController::class, 'index']);
Route::post('/petugas', [petugasController::class, 'store']);
Route::get('/petugas/{id}', [petugasController::class, 'show']);
Route::put('/petugas/{id}', [petugasController::class, 'update']);
Route::delete('/petugas/{id}', [petugasController::class, 'destroy']);

Route::get('/pelanggan', [pelangganController::class, 'index']);
Route::post('/pelanggan', [pelangganController::class, 'store']);
Route::get('/pelanggan/{id}', [pelangganController::class, 'show']);
Route::put('/pelanggan/{id}', [pelangganController::class, 'update']);
Route::delete('/pelanggan/{id}', [pelangganController::class, 'destroy']);

Route::get('/kereta', [keretaController::class, 'index']);
Route::post('/kereta', [keretaController::class, 'store']);
Route::get('/kereta/{id}', [keretaController::class, 'show']);
Route::put('/kereta/{id}', [keretaController::class, 'update']);
Route::delete('/kereta/{id}', [keretaController::class, 'destroy']);

Route::get('/gerbong', [gerbongController::class, 'index']);
Route::post('/gerbong', [gerbongController::class, 'store']);
Route::get('/gerbong/{id}', [gerbongController::class, 'show']);
Route::put('/gerbong/{id}', [gerbongController::class, 'update']);
Route::delete('/gerbong/{id}', [gerbongController::class, 'destroy']);

Route::get('/kursi', [kursiController::class, 'index']);
Route::post('/kursi', [kursiController::class, 'store']);
Route::get('/kursi/{id}', [kursiController::class, 'show']);
Route::put('/kursi/{id}', [kursiController::class, 'update']);
Route::delete('/kursi/{id}', [kursiController::class, 'destroy']);

Route::get('/jadwal', [jadwalController::class, 'index']);
Route::post('/jadwal', [jadwalController::class, 'store']);
Route::get('/jadwal/{id}', [jadwalController::class, 'show']);
Route::put('/jadwal/{id}', [jadwalController::class, 'update']);
Route::delete('/jadwal/{id}', [jadwalController::class, 'destroy']);
