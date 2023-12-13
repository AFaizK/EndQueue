<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InstansiController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'signin']);
Route::post('/register', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'signout']);
Route::apiResource('instansi',InstansiController::class);
Route::apiResource('layanan',LayananController::class);
Route::apiResource('user',UserController::class);
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/dashboard', DashboardController::class . '@index');
// });
