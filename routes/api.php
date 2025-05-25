<?php

use App\Http\Controllers\Api\MobileAuthController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\PlanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Test route sederhana untuk debugging
Route::get('/test', function() {
    return response()->json(['message' => 'API is working!']);
});

// Route Mobile API tanpa CSRF protection
Route::post('/mobile/register', [MobileAuthController::class, 'register']);
Route::post('/mobile/login', [MobileAuthController::class, 'login']);

// Protected Mobile Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/mobile/logout', [MobileAuthController::class, 'logout']);
    Route::get('/mobile/profile', [MobileAuthController::class, 'profile']);

    Route::get('/transaksi', [TransaksiController::class, 'index']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

    Route::get('/plan', [PlanController::class, 'index']);  
    Route::post('/plan', [PlanController::class, 'store']);
    Route::get('/plan/{id}', [PlanController::class, 'show']);
    Route::put('/plan/{id}', [PlanController::class, 'update']);
    Route::delete('/plan/{id}', [PlanController::class, 'destroy']);
});

// Route publik
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route untuk login admin
Route::post('/admin/login', [App\Http\Controllers\Api\AdminAuthController::class, 'login']);

// Route terproteksi (memerlukan token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
    Route::prefix('admin')->group(function () {
        Route::get('/profile', [App\Http\Controllers\Api\AdminAuthController::class, 'profile']);
        Route::post('/logout', [\App\Http\Controllers\Api\AdminAuthController::class, 'logout']);
    });

    // Mengarahkan ke ApiService yang sudah dibuat (Income, Outcome)
    Route::prefix('income')->group(function () {
        Route::get('/', [App\Filament\Resources\IncomeResource\Api\Handlers\PaginationHandler::class, 'handler']);
        Route::get('/{id}', [App\Filament\Resources\IncomeResource\Api\Handlers\DetailHandler::class, 'handler']);
        Route::post('/', [App\Filament\Resources\IncomeResource\Api\Handlers\CreateHandler::class, 'handler']);
        Route::put('/{id}', [App\Filament\Resources\IncomeResource\Api\Handlers\UpdateHandler::class, 'handler']);
        Route::delete('/{id}', [App\Filament\Resources\IncomeResource\Api\Handlers\DeleteHandler::class, 'handler']);
    });
    
    Route::prefix('outcome')->group(function () {
        Route::get('/', [App\Filament\Resources\OutcomeResource\Api\Handlers\PaginationHandler::class, 'handler']);
        Route::get('/{id}', [App\Filament\Resources\OutcomeResource\Api\Handlers\DetailHandler::class, 'handler']);
        Route::post('/', [App\Filament\Resources\OutcomeResource\Api\Handlers\CreateHandler::class, 'handler']);
        Route::put('/{id}', [App\Filament\Resources\OutcomeResource\Api\Handlers\UpdateHandler::class, 'handler']);
        Route::delete('/{id}', [App\Filament\Resources\OutcomeResource\Api\Handlers\DeleteHandler::class, 'handler']);
    });
    
    Route::prefix('pengguna')->group(function () {
        Route::get('/', [App\Filament\Resources\PenggunaResource\Api\Handlers\PaginationHandler::class, 'handler']);
        Route::get('/{id}', [App\Filament\Resources\PenggunaResource\Api\Handlers\DetailHandler::class, 'handler']);
        Route::post('/', [App\Filament\Resources\PenggunaResource\Api\Handlers\CreateHandler::class, 'handler']);
        Route::put('/{id}', [App\Filament\Resources\PenggunaResource\Api\Handlers\UpdateHandler::class, 'handler']);
        Route::delete('/{id}', [App\Filament\Resources\PenggunaResource\Api\Handlers\DeleteHandler::class, 'handler']);
    });
});