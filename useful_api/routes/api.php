<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleControlller;
use App\Http\Controllers\ShortLinkController;
use App\Http\Controllers\TransferController;
use App\Http\Middleware\CheckModuleActive;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


Route::post('/modules/{id}/activate', [ModuleControlller::class, 'activate'])->middleware('auth:sanctum');
Route::post('/modules/{id}/deactivate', [ModuleControlller::class, 'deactivate'])->middleware('auth:sanctum');
Route::get('/modules', [ModuleControlller::class, 'index'])->middleware('auth:sanctum');



Route::post('/shorten', [ShortLinkController::class, 'create'])->middleware('auth:sanctum', 'App\Http\Middleware\CheckModuleActive:1');

Route::get('/s/{code}', [ShortLinkController::class, 'redirectWithShort']);

Route::get('/links', [ShortLinkController::class, 'getlink'])->middleware('auth:sanctum', 'App\Http\Middleware\CheckModuleActive:1');

Route::delete('/links/{id}', [ShortLinkController::class, 'destroy'])->middleware('auth:sanctum', 'App\Http\Middleware\CheckModuleActive:1');


Route::post('/wallet/transfert', [TransferController::class, 'registerWallet'])->middleware('auth:sanctum', 'App\Http\Middleware\CheckModuleActive:2');
