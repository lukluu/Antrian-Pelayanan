<?php

use GuzzleHttp\Middleware;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\SurveiController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardAntrianController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('home', [
        "title" => "Ambil Antrian"
    ]);
});
Route::post('/submit-antrian', [AntrianController::class, 'store']);
Route::get('/ambil-antrian', [AntrianController::class, 'index'])->middleware('guest');
Route::get('/survei', [SurveiController::class, 'index'])->middleware('guest');
Route::get('/survei/isi-survei', [SurveiController::class, 'survei'])->middleware('guest');
Route::get('/survei/isi-survei/{id}', [SurveiController::class, 'show'])->middleware('guest');
Route::put('/survei/isi-survei/{id}', [SurveiController::class, 'update'])->middleware('guest');


Route::get('/keep-antrian/{id}', [AntrianController::class, 'show'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);



Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/data-instansi', [OutletController::class, 'index']);
    Route::get('/dashboard/data-antrian', [DashboardAntrianController::class, 'index']);
    Route::get('/dashboard/data-antrian/filter', [DashboardAntrianController::class, 'index']);
    Route::get('/dashboard/data-user', [UserController::class, 'index']);
    Route::post('/dashboard/data-user/tambah-user', [UserController::class, 'create']);
    Route::get('/dashboard/data-user/tambah-user', [UserController::class, 'show']);
    Route::post('/dashboard/data-instansi/tambah-instansi', [OutletController::class, 'create']);
    Route::get('/dashboard/data-instansi/tambah-instansi', [OutletController::class, 'tambah']);
    Route::delete('/dashboard/data-user/delete/{id}', [UserController::class, 'destroy'])->name('dashboard.data-user.delete');
    Route::delete('/dashboard/data-instansi/delete/{id}', [OutletController::class, 'destroy'])->name('dashboard.data-instansi.delete');
    Route::get('/dashboard/data-instansi/detail/{id}', [OutletController::class, 'detail']);
    Route::post('/dashboard/data-instansi/submit-layanan', [OutletController::class, 'createLayanan']);
    Route::delete('/dashboard/data-instansi/detail/{id}', [OutletController::class, 'destroyLayanan'])->name('dashboard.data-instansi.detail');
    Route::post('/dashboard/data-instansi/detail/edit-layanan/{id}', [OutletController::class, 'editLayanan'])->name('dashboard.edit-layanan');
    Route::get('/dashboard/data-instansi/edit/{id}', [OutletController::class, 'editInstansi'])->name('dashboard.data-instansi.edit');
    Route::put('/dashboard/data-instansi/edit/{id}', [OutletController::class, 'update'])->name('dashboard.data-instansi.edit');
    Route::get('/dashboard/data-user/edit/{id}', [UserController::class, 'editUser']);
    Route::put('/dashboard/data-user/edit/{id}', [UserController::class, 'update'])->name('dashboard.data-user.edit');
    Route::get('/dashboard/antrian/detail/{id}', [DashboardAntrianController::class, 'detail']);
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/user/dashboard', [DashboardUserController::class, 'index']);
    Route::get('/user/dashboard/terlayani', [DashboardUserController::class, 'terlayani']);
    Route::get('/dashboard/terlayani/filter', [DashboardUserController::class, 'terlayani']);
    Route::get('/user/dashboard/setting', [DashboardUserController::class, 'setting']);
    Route::put('/user/dashboard/setting/{id}', [DashboardUserController::class, 'editUser'])->name('user.dashboard.setting');
    Route::get('/user/dashboard/cetak', [DashboardUserController::class, 'cetak']);
    Route::get('/user/dashboard/survei-pengunjung/show/{id}', [DashboardUserController::class, 'showSurvei']);
    Route::get('/user/dashboard/survei/hasil-survei/{id}', [DashboardUserController::class, 'showSurvei']);
    Route::get('/user/dashboard/survei/unduh-excel/{id}', [DashboardUserController::class, 'unduhExcel'])->name('survei.unduh.excel');
    Route::get('/user/dashboard/survei-pengunjung', [DashboardUserController::class, 'survei']);
    // Route::get('/user/dashboard/confirm/{antrianId}', [DashboardUserController::class, 'confirmAndSave'])->name('user.dashboard.confirm_save');
    Route::post('/user/dashboard/layani/{antrianId}', [DashboardUserController::class, 'layani'])->name('user.dashboard.layani');
    Route::post('/user/dashboard/selesai/{antrianId}', [DashboardUserController::class, 'selesai'])->name('user.dashboard.selesai');
    Route::get('/user/dashboard/detail/{antrianId}', [DashboardUserController::class, 'detail'])->name('user.detail');
    Route::put('/user/dashboard/data-melayani/{id}', [DashboardUserController::class, 'update'])->name('user.update');
    Route::get('/user/dashboard/terlayani/detail/{id}', [DashboardUserController::class, 'detailTerlayani']);
    Route::get('/user/dashboard/syarat-layanan', [DashboardUserController::class, 'syarat']);
    Route::get('/user/dashboard/syarat-layanan/edit/{id}', [DashboardUserController::class, 'syaratEdit']);
    Route::put('/user/dashboard/data-melayani/update/{id}', [DashboardUserController::class, 'syaratUpdate']);
    Route::get('/user/dashboard/data-terlayani/cetak', [DashboardUserController::class, 'showCetak']);
    Route::get('/user/dashboard/data-terlayani/mulai-cetak/', [DashboardUserController::class, 'mulaiCetak']);
});
