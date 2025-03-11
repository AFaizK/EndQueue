<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthPengunjungController;
use App\Http\Controllers\Api\InstansiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AntrianController;
use App\Http\Controllers\Api\ProfileController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// landing page
Route::get('/landingpage', function () {
    return view('pengguna.landingpage');
});

// login admin
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'signout']);

// pengunjung
Route::post('/registerpengunjung', [AuthPengunjungController::class, 'register']);
Route::post('/loginpengunjung', [AuthPengunjungController::class, 'login']);
Route::get('/loginpengunjung', function () {
    return view('pengguna.login');
})->name('loginpengunjung');
Route::get('/registerpengunjung', function () {
    return view('pengguna.register');
});
Route::post('/logoutpengunjung', [AuthPengunjungController::class, 'logout']);
Route::middleware('api_pengunjungs')->group(function(){
    Route::get('/booking', function () {
        return view('pengguna.pengunjung');
    });
});

// middleware super admin
Route::middleware('role:Super Admin')->group(function () {
    // User
    Route::get('/user', function () {
        return view('pages.user.user');
    });
});

Route::get('/get-profile', [profileController::class, 'fetchData']);

Route::middleware(['auth.sanctum'])->group(function () {
    Route::put('/edit-profile', [ProfileController::class, 'update']);

    Route::get('/edit-profile', [profileController::class, 'edit']);
    Route::get('/dashboard', function() {
       return view('pages.index-2');
    });

    Route::get('/pengunjung', function () {
        return view('pages.pengunjung.pengunjung');
    });
     // Instansi

    Route::get("/instansi", function () {
        return view('pages.instansi.instansi');
    });

    // Layanan
    Route::get('/layanan', function () {
        return view('pages.layanan.layanan');
    });

    // Antrian
    Route::get('/antrian', function () {
        return view('pages.antrian.antrian');
    });

});

<<<<<<< HEAD
=======

    // Pengunjung
    Route::get('/penggunalandingpage', function () {
        return view('/pengguna/landingpage');
    });
    
    Route::get('/endqueuebooking', function () {
        return view('/pengguna/endqueue');
    });
    
    Route::get('/endqueuepilihlayanan', function () {
        return view('/pengguna/pilih_layanan');
    });
    
    Route::get('/endqueuetiket', function () {
        return view('/pengguna/endqueue_tiket');
    });

// });


>>>>>>> b89d791a46e9c7b6cb2b53133ea1f679737a1005
