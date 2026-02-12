<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProductoDataController;


Route::get('/', function () {
    return redirect()->route('login');
});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [ProductoController::class, 'index'])->name('dashboard');

    // API interna (JSON)
    Route::get('/productos-data', [ProductoDataController::class, 'index']);
    Route::post('/productos-data', [ProductoDataController::class, 'store']);
    Route::put('/productos-data/{producto}', [ProductoDataController::class, 'update']);
    Route::get('/productos-data/{producto}', [ProductoDataController::class, 'show']);
    Route::delete('/productos-data/{producto}', [ProductoDataController::class, 'destroy']);
});
