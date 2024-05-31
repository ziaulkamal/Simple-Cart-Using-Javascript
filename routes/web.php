<?php

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\KurikulumController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengajarController;
use Illuminate\Support\Facades\Route;





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

Route::get('/', function () {
        return view('index');
    }
);
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);

Route::get('/filter', [MahasiswaController::class, 'filter'])->name('fill');
Route::get('/jj/{value}', [MahasiswaController::class, 'optJenjang'])->name('jj');
Route::get('/fk/{value}', [MahasiswaController::class, 'optFakultas'])->name('fk');
Route::get('/dynamic', [MahasiswaController::class, 'dynamicOpt'])->name('dynamic');
Route::get('/mahasiswa/data', [MahasiswaController::class, 'getData'])->name('mhs.data');

Route::get('/pengajar', [PengajarController::class, 'index']);
Route::get('/pengajar/filter', [PengajarController::class, 'filter'])->name('filter.pengajar');


Route::get('/kurikulum', [KurikulumController::class, 'index']);
Route::get('/kurikulum/filter', [KurikulumController::class, 'filter']);
Route::get('/kurikulum/jj/{value}', [KurikulumController::class, 'optJenjang'])->name('k.jj');
Route::get('/kurikulum/fk/{value}', [KurikulumController::class, 'optFakultas'])->name('k.fk');
Route::get('/kurikulum/pd/{value}', [KurikulumController::class, 'optProdi'])->name('k.pd');


Route::get('/kurikulum/dynamic', [KurikulumController::class, 'dynamicOpt'])->name('k.dynamic');
Route::get('/kurikulum/data/{jenjang}/{fakultas}/{prodi}', [KurikulumController::class, 'groupingData'])->name('kurikulum.data');

