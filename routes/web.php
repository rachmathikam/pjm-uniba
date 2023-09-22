<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TupoksiController;
use App\Http\Controllers\PersonaliaController;
use App\Http\Controllers\KategoriSubKategoriController;
use App\Http\Controllers\KategoriSubKategoriDokumenController;
use App\Http\Controllers\PengurusPersonaliaController;
use App\Http\Controllers\DivisiPjmController;
use App\Http\Controllers\PengurusDivisiPjmController;
use App\Http\Controllers\DokumenController;




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


//Kategori Profile
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
Route::post('/tupoksi-status', [App\Http\Controllers\TupoksiController::class, 'status'])->name('tupoksi.status');

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


// divisi pjm
Route::resource('divisi_pjm',DivisiPjmController::class);
Route::post('/divisi_pjm-updated', [App\Http\Controllers\DivisiPjmController::class, 'updated'])->name('divisi_pjm.updated');
Route::post('/divisi_pjm-delete', [App\Http\Controllers\DivisiPjmController::class, 'delete'])->name('divisi_pjm.delete');
Route::post('/divisi_pjm-updated', [App\Http\Controllers\DivisiPjmController::class, 'updated'])->name('divisi_pjm.updated');
Route::post('/divisi_pjm-filter', [App\Http\Controllers\DivisiPjmController::class, 'filter'])->name('divisi_pjm.filter');
Route::post('/divisi_pjm-status', [App\Http\Controllers\DivisiPjmController::class, 'status'])->name('divisi_pjm.status');

//pengurus divisi
Route::resource('pengurus_divisi_pjm',PengurusDivisiPjmController::class);
Route::post('/pengurus_divisi_pjm-updated', [App\Http\Controllers\PengurusDivisiPjmController::class, 'updated'])->name('pengurus_divisi_pjm.updated');
Route::post('/pengurus_divisi_pjm-delete', [App\Http\Controllers\PengurusDivisiPjmController::class, 'delete'])->name('pengurus_divisi_pjm.delete');
Route::post('/pengurus_divisi_pjm-updated', [App\Http\Controllers\PengurusDivisiPjmController::class, 'updated'])->name('pengurus_divisi_pjm.updated');
Route::post('/pengurus_divisi_pjm-filter', [App\Http\Controllers\PengurusDivisiPjmController::class, 'filterPengurus'])->name('pengurus_divisi_pjm.filter');

// Kategori Dokumen
Route::resource('kategori_dokumen',KategoriSubKategoriDokumenController::class);
Route::post('/kategori_dokumen-kategori', [App\Http\Controllers\KategoriSubKategoriDokumenController::class, 'kategori'])->name('kategori_dokumen.kategori');
Route::post('/kategori_dokumen-sub', [App\Http\Controllers\KategoriSubKategoriDokumenController::class, 'sub'])->name('kategori_dokumen.sub');
Route::post('/kategori_dokumen-master', [App\Http\Controllers\KategoriSubKategoriDokumenController::class, 'master'])->name('kategori_dokumen.master');
Route::post('/kategori_dokumen-delete', [App\Http\Controllers\KategoriSubKategoriDokumenController::class, 'delete'])->name('kategori_dokumen.delete');
Route::post('/kategori_dokumen-updated', [App\Http\Controllers\KategoriSubKategoriDokumenController::class, 'updated'])->name('kategori_dokumen.updated');

//pengurus divisi
Route::resource('dokumen',DokumenController::class);
Route::post('/dokumen-updated', [App\Http\Controllers\DokumenController::class, 'updated'])->name('dokumen.updated');
Route::post('/dokumen-delete', [App\Http\Controllers\DokumenController::class, 'delete'])->name('dokumen.delete');
Route::post('/dokumen-updated', [App\Http\Controllers\DokumenController::class, 'updated'])->name('dokumen.updated');
Route::post('/dokumen-filter', [App\Http\Controllers\DokumenController::class, 'filterPengurus'])->name('dokumen.filter');
