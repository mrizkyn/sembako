<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SembakoController;
use App\Http\Controllers\SembakokeluarController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\SembakomasukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
 

    // Admin
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin/dashboard', [SembakoController::class, 'index'])->name('dashboard');

        //sembako masuk
        Route::get('/admin/sembako-masuk', [SembakomasukController::class, 'index'])->name('masuk');
        Route::post('/admin/sembako-masuk/store', [SembakomasukController::class, 'store'])->name('masuk.store');
        Route::get('/admin/sembako-masuk/move-to-keluar/{id}', [SembakomasukController::class, 'moveToKeluar'])->name('masuk.moveToKeluar');
        Route::get('/keluarkan/{id}', [SembakomasukController::class, 'keluarkanForm'])->name('keluar.form');
        Route::post('/keluarkan/{id}', [SembakomasukController::class, 'keluarkan'])->name('keluar.keluarkan');
                
        //route satuan
        Route::get('/admin/satuan', [UnitController::class, 'index'])->name('satuan');
        Route::post('/admin/satuan/store', [UnitController::class, 'store'])->name('satuan.store');
        Route::put('/admin/satuan/update/{id}', [UnitController::class, 'update'])->name('satuan.update');
        Route::delete('/admin/satuan/destroy/{id}', [UnitController::class, 'destroy'])->name('satuan.destroy');

        //route kategori
        Route::get('/admin/kategori', [CategoryController::class, 'index'])->name('kategori');
        Route::post('/admin/kategori', [CategoryController::class, 'store'])->name('kategori.store');
        Route::put('/admin/kategori/update/{id}', [CategoryController::class, 'update'])->name('kategori.update');
        Route::delete('/admin/kategori/destroy/{id}', [CategoryController::class, 'destroy'])->name('kategori.destroy');

        //route sembako keluar
        Route::get('/admin/sembako-keluar', [SembakokeluarController::class, 'index'])->name('keluar');
        Route::post('/admin/sembako-keluar/store', [SembakokeluarController::class, 'store'])->name('keluar.store');
        Route::get('/keluarkan/{id}', [SembakokeluarController::class, 'keluarkanForm'])->name('keluar.form');
        Route::post('/keluarkan/{id}', [SembakokeluarController::class, 'keluarkan'])->name('keluar.keluarkan');
        Route::post('/keluar/store', [SembakoKeluarController::class, 'store'])->name('sembako-keluar.store');        

        //route spatie
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('products', ProductController::class);
    });

    // Owner
    Route::group(['middleware' => ['role:owner']], function () {
        Route::get('/owner/dashboard', [OwnerController::class, 'index'])->name('owner.dashboard');
        Route::get('/owner/laporan/sembako-masuk', [OwnerController::class, 'reportin'])->name('owner.masuk');
        Route::get('/owner/laporan/sembako-keluar', [OwnerController::class, 'reportout'])->name('owner.keluar');
        Route::get('/owner/laporan/cetak-sembako-masuk', [OwnerController::class, 'printin'])->name('owner.print1');
        Route::get('/owner/laporan/cetak-sembako-keluar', [OwnerController::class, 'printout'])->name('owner.print2');

    });
});


Auth::routes();


Route::get('/', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
