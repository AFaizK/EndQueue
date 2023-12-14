<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;




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
Route::get('/login', [AuthController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/edit-profile', function () {
    return view('pages.edit-profile');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);

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
     Route::get('/instansi', function () {
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


    // User
    Route::get('/user', function () {
        return view('pages.user.user');
    });
    Route::get('/tambahuser', function () {
        return view('pages.user.tambahuser');
    });
    Route::get('/tambahrole', function () {
        return view('pages.user.tambahrole');
    });
    Route::get('/edituser', function () {
        return view('pages.user.edituser');
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


