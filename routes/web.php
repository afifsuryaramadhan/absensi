<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::group(['as'=>'', 'prefix'=>'/'], function() {
    Route::get('', function() {
        return redirect()->route('login');
    });


    Route::group(['as'=>'manajemen.', 'prefix'=>'manajemen/'], function() {

        // manajemen-role
        Route::group(['as'=>'role.','prefix'=>'role/', 'middleware'=>'permission:manajemen-role'], function () {
            Route::get('', [RoleController::class,'index'])->name('index');
            Route::get('create', [RoleController::class,'create'])->name('create');
            Route::post('store', [RoleController::class,'store'])->name('store');
            Route::get('show/{id}', [RoleController::class,'show'])->name('show');
            Route::get('edit/{id}', [RoleController::class,'edit'])->name('edit');
            Route::post('update/{id}', [RoleController::class,'update'])->name('update');
            Route::delete('delete/{id}', [RoleController::class,'delete'])->name('delete');
        });

        // manajemen-permission
        Route::group(['as'=>'permission.','prefix'=>'permission/','middleware'=>'permission:manajemen-permission'], function () {
            Route::get('', [PermissionController::class,'index'])->name('index');
            Route::get('create', [PermissionController::class,'create'])->name('create');
            Route::post('store', [PermissionController::class,'store'])->name('store');
            Route::get('edit/{id}', [PermissionController::class,'edit'])->name('edit');
            Route::post('update/{id}', [PermissionController::class,'update'])->name('update');
            Route::delete('delete/{id}', [PermissionController::class,'delete'])->name('delete');
        });

        // Manajemen user
        Route::group(['as'=>'user.', 'prefix'=>'user/', 'middleware'=>'permission:manajemen-user'], function () {
            Route::get('', [UserController::class,'index'])->name('index');
            Route::get('create', [UserController::class,'create'])->name('create');
            Route::post('store', [UserController::class,'store'])->name('store');
            Route::get('edit/{id}', [UserController::class,'edit'])->name('edit');
            Route::get('show/{id}', [UserController::class,'show'])->name('show');
            Route::post('update/{id}', [UserController::class,'update'])->name('update');
            Route::delete('delete/{id}', [UserController::class,'delete'])->name('delete');
        });

        // Manajemen anggota
        Route::group(['as'=>'anggota.', 'prefix'=>'anggota/', 'middleware'=>'permission:anggota-list'], function () {
            Route::get('', [AnggotaController::class,'index'])->name('index');
            Route::get('show/{id}', [AnggotaController::class,'show'])->name('show');

            Route::group(['middleware'=>'permission:anggota-create'], function() {
                Route::get('create', [AnggotaController::class,'create'])->name('create');
                Route::post('store', [AnggotaController::class,'store'])->name('store');
            });

            Route::group(['middleware'=>'permission:anggota-edit'], function() {
                Route::get('edit/{id}', [AnggotaController::class,'edit'])->name('edit');
                Route::post('update/{id}', [AnggotaController::class,'update'])->name('update');
            });
            Route::middleware('permission:anggota-delete')->delete('delete/{id}', [AnggotaController::class,'delete'])->name('delete');

            Route::group(['middleware'=>'permission:ganti-ketua'], function() {
                Route::get('jadikan-ketua/{id}', [AnggotaController::class,'gantiKetua'])->name('jadikan-ketua');
                Route::get('copot-ketua/{id}', [AnggotaController::class,'gantiKetua'])->name('copot-ketua');
            });
        });


        // Manajemen Jadwal
        Route::group(['as'=>'kegiatan.', 'prefix'=>'kegiatan/', 'middleware'=>'permission:jadwal'], function () {
            Route::get('', [KegiatanController::class,'index'])->name('index');
            Route::get('show/{id}', [KegiatanController::class,'show'])->name('show');
            
            Route::group(['middleware'=>'permission:jadwal-create'], function() {
                Route::get('create', [KegiatanController::class,'create'])->name('create');
                Route::post('store', [KegiatanController::class,'store'])->name('store');
            });            


            Route::group(['middleware'=>'permission:jadwal-edit'], function() {
                Route::get('edit/{id}', [KegiatanController::class,'edit'])->name('edit');
                Route::post('update/{id}', [KegiatanController::class,'update'])->name('update');
            });

            Route::middleware('permission:jadwal-delete')->delete('delete/{id}', [KegiatanController::class,'delete'])->name('delete');
        });


        // Manajemen absensi
        Route::group(['as'=>'absensi.', 'prefix'=>'absensi/', 'middleware'=>'permission:absensi-list'], function () {
            Route::get('', [AbsensiController::class,'list'])->name('index');
            Route::middleware('permission:absensi-export')->get('eksport', [AbsensiController::class,'eksport'])->name('eksport');
            Route::middleware('permission:absensi-approve')->patch('approve/{id}', [AbsensiController::class,'approve'])->name('approve');
        });    
    });
    
    // Absensi
    Route::group(['as'=>'absensi.', 'prefix'=>'absensi/', 'middleware'=>'permission:absensi'], function () {
        Route::get('', [AbsensiController::class,'index'])->name('index');

        Route::group(['middleware'=>'permission:absensi-submit'], function () {
            Route::get('create', [AbsensiController::class,'create'])->name('create');
            Route::post('submit', [AbsensiController::class,'submit'])->name('submit');
        });
    });
});