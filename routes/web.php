<?php

use GuzzleHttp\Middleware;



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutletController;
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
});

Route::group(['middleware' => ['role:user']], function () {
    Route::get('/user/dashboard', [DashboardUserController::class, 'index']);
    Route::get('/user/dashboard/terlayani', [DashboardUserController::class, 'terlayani']);
    // Route::get('/user/dashboard/confirm/{antrianId}', [DashboardUserController::class, 'confirmAndSave'])->name('user.dashboard.confirm_save');
    Route::post('/user/dashboard/layani/{antrianId}', [DashboardUserController::class, 'layani'])->name('user.dashboard.layani');
    Route::post('/user/dashboard/selesai/{antrianId}', [DashboardUserController::class, 'selesai'])->name('user.dashboard.selesai');
    Route::get('/user/dashboard/detail/{antrianId}', [DashboardUserController::class, 'detail']);
});