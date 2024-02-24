<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InstansiController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\PengunjungController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AntrianController;
use App\Http\Controllers\Api\AuthPengunjungController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProfileController;




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

// auth user admin
Route::post('/logout', [AuthController::class, 'signout']);
Route::post('/login', [AuthController::class, 'signin']);
Route::post('/register', [AuthController::class, 'signup']);

// auth user pengunjung
Route::post('/loginpengunjung', [AuthPengunjungController::class, 'signin']);
Route::post('/registerpengunjung', [AuthPengunjungController::class, 'signup']);
Route::post('/logoutpengunjung', [AuthPengunjungController::class, 'logout']);

// instansi
Route::post('/instansi/search', [InstansiController::class, 'search']);
Route::apiResource('instansi',InstansiController::class);
Route::get('/getall-instansi', [InstansiController::class, 'getAll']);

// antrian
Route::post('/antrian/search', [AntrianController::class, 'search']);
Route::get('/antrian/pagination', [AntrianController::class, 'pagination']);
Route::apiResource('/antrian',AntrianController::class);

// layanan
Route::get('/layanan/pagination', [LayananController::class, 'pagination']);
Route::post('/layanan/search', [LayananController::class, 'search']);
Route::apiResource('layanan',LayananController::class);


// user
Route::get('/user/pagination', [UserController::class, 'pagination']);
Route::post('/user/search', [UserController::class, 'search']);
Route::apiResource('/user',UserController::class);



// pengunjung
Route::post('/pengunjung/search', [PengunjungController::class, 'search']);
Route::get('/pengunjung/pagination', [PengunjungController::class, 'pagination']);
Route::apiResource('/pengunjung',PengunjungController::class);



// dashboard
Route::get('/pengunjung-harian', [DashboardController::class, 'dataPengunjungPerHari']);
Route::get('/pengunjung-bulanan', [DashboardController::class, 'dataPengunjungPerBulan']);
Route::get('/antrian-harian', [DashboardController::class, 'dataAntrianPerHari']);
Route::get('/antrian-bulanan', [DashboardController::class, 'dataAntrianPerBulan']);
Route::get('/antrian-card-harian', [DashboardController::class, 'dataCardHarian']);
Route::get('/layanan-bulanan', [DashboardController::class, 'dataLayananPerBulan']);
Route::get('/layanan-harian', [DashboardController::class, 'dataLayananHarian']);

// profile
Route::get('/edit-profile', [ProfileController::class, 'edit']);







    // Route::get('/get-profile', [profileController::class, 'fetchData']);

// Route::middleware('auth:sanctum')->group(function () {

//     Route::get('/dashboard', DashboardController::class . '@index');
// });
