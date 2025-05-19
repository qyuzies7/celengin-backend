<?php

use App\Http\Controllers\Api\MobileAuthController;
use App\Http\Controllers\Api\AuthController;
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
});

// Route publik
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route terproteksi (memerlukan token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    
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