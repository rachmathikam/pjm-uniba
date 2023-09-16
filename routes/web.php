<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TupoksiController;
use App\Http\Controllers\PersonaliaController;
use App\Http\Controllers\KategoriSubKategoriController;
use App\Http\Controllers\PengurusPersonaliaController;
use App\Http\Controllers\DevisiEksplorasiDataController;




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


// Master Kategori
Route::resource('kategori',KategoriSubKategoriController::class);
Route::post('/kategori-kategori', [App\Http\Controllers\KategoriSubKategoriController::class, 'kategori'])->name('kategori.kategori');
Route::post('/kategori-sub', [App\Http\Controllers\KategoriSubKategoriController::class, 'sub'])->name('kategori.sub');
Route::post('/kategori-master', [App\Http\Controllers\KategoriSubKategoriController::class, 'master'])->name('kategori.master');


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
Route::post('/tupoksi-updated', [App\Http\Controllers\TupoksiController::class, 'updated'])->name('tupoksi.updated');

//personalia
Route::resource('personalia',PersonaliaController::class);
Route::post('/personalia-updated', [App\Http\Controllers\PersonaliaController::class, 'updated'])->name('personalia.updated');
Route::post('/personalia-delete', [App\Http\Controllers\PersonaliaController::class, 'delete'])->name('personalia.delete');
Route::post('/personalia-updated', [App\Http\Controllers\PersonaliaController::class, 'updated'])->name('personalia.updated');

//pengurus personalia
Route::resource('pengurus_personalia',PengurusPersonaliaController::class);
Route::post('/pengurus_personalia-updated', [App\Http\Controllers\PengurusPersonaliaController::class, 'updated'])->name('pengurus_personalia.updated');
Route::post('/pengurus_personalia-delete', [App\Http\Controllers\PengurusPersonaliaController::class, 'delete'])->name('pengurus_personalia.delete');
Route::post('/pengurus_personalia-updated', [App\Http\Controllers\PengurusPersonaliaController::class, 'updated'])->name('pengurus_personalia.updated');


// divisi eksplorasi data
Route::resource('devisi_eksplorasi_data',DevisiEksplorasiDataController::class);
Route::post('/devisi_eksplorasi_data-updated', [App\Http\Controllers\DevisiEksplorasiDataController::class, 'updated'])->name('devisi_eksplorasi_data.updated');
Route::post('/devisi_eksplorasi_data-delete', [App\Http\Controllers\DevisiEksplorasiDataController::class, 'delete'])->name('devisi_eksplorasi_data.delete');
Route::post('/devisi_eksplorasi_data-updated', [App\Http\Controllers\DevisiEksplorasiDataController::class, 'updated'])->name('devisi_eksplorasi_data.updated');


