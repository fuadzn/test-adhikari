<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']); 
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/', [UserController::class, 'store']); 
        Route::put('/{id}', [AuthController::class, 'update']); 
        Route::delete('/{id}', [UserController::class, 'destroy']); 
        Route::get('/by-nama/{nama}', [UserController::class, 'getByNama']); 
        Route::get('/by-NIM/{NIM}', [UserController::class, 'getByNIM']); 
        Route::get('/by-YMD/{YMD}', [UserController::class, 'getByYMD']); 
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
