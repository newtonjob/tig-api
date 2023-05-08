<?php

use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BundleController;
use App\Http\Controllers\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/token',  AuthController::class)->name('auth.token');
Route::post('/airtime',     AirtimeController::class)->name('airtime');
Route::post('/data',        DataController::class)->name('data');
Route::post('/bundles',     BundleController::class)->name('data');
