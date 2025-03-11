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

// Dashboard

// Route::get('/index-2', function () {
//     return view('pages.index-2');
// });
// edit Profile
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/search', [AntrianController::class, 'search']);
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

Route::middleware('role:Super Admin')->group(function () {
    // User
    Route::get('/user', function () {
        return view('pages.user.user');
    });
    Route::get('/tambahuser', function () {
        return view('pages.user.tambahuser');
    });
    // Route::resource('/user/{instansi}', [UserController::class, 'update']);
    Route::get('/tambahrole', function () {
        return view('pages.user.tambahrole');
    });
    Route::get('/edituser', function () {
        return view('pages.user.edituser');
    });
});

Route::get('/get-profile', [profileController::class, 'fetchData']);
Route::middleware(['auth.sanctum'])->group(function () {
    Route::put('/edit-profile', [ProfileController::class, 'update']);

    Route::get('/edit-profile', [profileController::class, 'edit']);
    Route::get('/dashboard', function() {
       return view('pages.index-2');
    });
    // Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/pengunjung', function () {
        return view('pages.pengunjung.pengunjung');
    });
    Route::get('/tambahpengunjung', function () {
        return view('pages.pengunjung.tambahpengunjung');
    });
    Route::get('/editpengunjung', function () {
        return view('pages.pengunjung.editpengunjung');
    });

     // Instansi
    // Route::resource('/instansi/{id}', [InstansiController::class, 'update']);
    Route::get("/instansi", function () {
        return view('pages.instansi.instansi');
    });

    // Layanan
    Route::get('/layanan', function () {
        return view('pages.layanan.layanan');
    });
    Route::get('/tambahlayanan', function () {
        return view('pages.layanan.tambahlayanan');
    });
    Route::get('/editlayanan', function () {
        return view('pages.layanan.editlayanan');
    });

    // Antrian
    Route::get('/antrian', function () {
        return view('pages.antrian.antrian');
    });
    Route::get('/tambahantrian', function () {
        return view('pages.antrian.tambahantrian');
    });
    Route::get('/editantrian', function () {
        return view('pages.antrian.editantrian');
    });

});


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


