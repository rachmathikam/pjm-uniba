<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\VisiMisiController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// visi misi
Route::resource('petugas',PetugasController::class);
Route::post('/petugas-delete', [App\Http\Controllers\PetugasController::class, 'delete'])->name('petugas.delete');
Route::post('/petugas-updated/{id}', [App\Http\Controllers\PetugasController::class, 'updated'])->name('petugas.updated');

// visi misi
Route::resource('visimisi',VisiMisiController::class);
Route::post('/tambah-visi', [App\Http\Controllers\VisiMisiController::class, 'tambahVisi'])->name('tambah.visi');
Route::post('/tambah-misi', [App\Http\Controllers\VisiMisiController::class, 'tambahMisi'])->name('tambah.misi');
Route::post('/tambah-tujuan', [App\Http\Controllers\VisiMisiController::class, 'tambahTujuan'])->name('tambah.tujuan');
Route::post('/edit-visimisi', [App\Http\Controllers\VisiMisiController::class, 'editVisiMisi'])->name('edit.visimisi');
Route::post('/delete-visimisi', [App\Http\Controllers\VisiMisiController::class, 'delete'])->name('visimisi.delete');



