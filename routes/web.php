<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFArtikel;
use App\Http\Controllers\PDFRepoB;

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



Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return redirect('dashboard');
});

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {

Route::get('/master', \App\Http\Livewire\Masterdata::class)->name('master');

Route::get('/dashboard', \App\Http\Livewire\Dashboard::class)->name('dashboard');
Route::get('/prasidang', \App\Http\Livewire\Prasidangs::class)->name('prasidang');
Route::get('/sidangseksi', \App\Http\Livewire\SidangSeksi::class)->name('sidangseksi');
Route::get('/sidangpleno', \App\Http\Livewire\SidangPlenos::class)->name('sidangpleno');


Route::get('/sidang', \App\Http\Livewire\Sidangs::class)->name('sidang');
Route::get('/user', \App\Http\Livewire\Users::class)->name('user');
Route::get('/daftarsidang', \App\Http\Livewire\Sidangs::class)->name('daftar-sidang');
Route::get('/seksi', \App\Http\Livewire\Seksis::class)->name('seksi');
Route::get('/peserta_sidang', \App\Http\Livewire\Peserta_sidangs::class)->name('peserta_sidang');
Route::get('/repo_a', \App\Http\Livewire\Repo_as::class)->name('repo_a');
Route::get('/repo_b', \App\Http\Livewire\Repo_bs::class)->name('repo_b');
Route::get('/artikel_seksi', \App\Http\Livewire\ArtikelSeksis::class)->name('artikel_seksi');
Route::get('/createartikelseksi', \App\Http\Livewire\CreateArtikelSeksi::class)->name('createartikelseksi');
Route::get('/artikel_seksi_pleno', \App\Http\Livewire\ArtikelSeksisPleno::class)->name('artikel_seksi_pleno');
Route::get('/artikel_pleno', \App\Http\Livewire\ArtikelPlenos::class)->name('artikel_pleno');


Route::get('/artikelPleno-pdf', [PDFArtikel::class, 'generatePDF']);
Route::get('/RepoB-pdf', [PDFRepoB::class, 'generatePDF']);

});



