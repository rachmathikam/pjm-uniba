<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TupoksiController;
use App\Http\Controllers\KategoriSubKategoriController;


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
    return view('frontend.layouts.app');
});

Route::get('/auth/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Petugas PJM Uniba
Route::resource('petugas',PetugasController::class);
Route::post('/petugas-delete', [App\Http\Controllers\PetugasController::class, 'delete'])->name('petugas.delete');
Route::post('/petugas-updated/{id}', [App\Http\Controllers\PetugasController::class, 'updated'])->name('petugas.updated');

// visi-misi / Tujuan PJM Uniba
Route::resource('visimisi',VisiMisiController::class);
Route::post('/tambah-visi', [App\Http\Controllers\VisiMisiController::class, 'tambahVisi'])->name('tambah.visi');
Route::post('/tambah-misi', [App\Http\Controllers\VisiMisiController::class, 'tambahMisi'])->name('tambah.misi');
Route::post('/tambah-tujuan', [App\Http\Controllers\VisiMisiController::class, 'tambahTujuan'])->name('tambah.tujuan');
Route::post('/edit-visimisi', [App\Http\Controllers\VisiMisiController::class, 'editVisiMisi'])->name('edit.visimisi');
Route::post('/delete-visimisi', [App\Http\Controllers\VisiMisiController::class, 'delete'])->name('visimisi.delete');

// berita PJM Uniba
Route::resource('berita',BeritaController::class);
Route::post('/berita-updated/{id}', [App\Http\Controllers\BeritaController::class, 'updated'])->name('berita.updated');
Route::post('/berita-delete', [App\Http\Controllers\BeritaController::class, 'delete'])->name('berita.delete');

// profile PJM Uniba
Route::resource('profile',ProfileController::class);
Route::post('/profile-updated', [App\Http\Controllers\ProfileController::class, 'updated'])->name('profile.updated');
Route::post('/profile-delete', [App\Http\Controllers\ProfileController::class, 'delete'])->name('profile.delete');

// tupoksi PJM Uniba
Route::resource('tupoksi',TupoksiController::class);
Route::post('/tupoksi-updated', [App\Http\Controllers\TupoksiController::class, 'updated'])->name('tupoksi.updated');
Route::post('/tupoksi-delete', [App\Http\Controllers\TupoksiController::class, 'delete'])->name('tupoksi.delete');

// Master Kategori
Route::resource('kategori',KategoriSubKategoriController::class);
Route::post('/kategori-kategori', [App\Http\Controllers\KategoriSubKategoriController::class, 'kategori'])->name('kategori.kategori');
Route::post('/kategori-sub', [App\Http\Controllers\KategoriSubKategoriController::class, 'sub'])->name('kategori.sub');
Route::post('/kategori-master', [App\Http\Controllers\KategoriSubKategoriController::class, 'master'])->name('kategori.master');


