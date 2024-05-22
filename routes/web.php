<?php

use App\Http\Controllers\DefaultController;
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


Route::get('/', [DefaultController::class, 'index'])->name('mahasiswa.index');
Route::get('/filter', [DefaultController::class, 'filter'])->name('fill');
Route::get('/jj/{value}', [DefaultController::class, 'optJenjang'])->name('jj');
Route::get('/fk/{value}', [DefaultController::class, 'optFakultas'])->name('fk');
Route::get('/dynamic', [DefaultController::class, 'dynamicOpt'])->name('dynamic');
Route::get('/mahasiswa/data', [DefaultController::class, 'getData'])->name('mhs.data');
