<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Bidangs;

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
    return view('dashboard');
})->name('dashboard');

Route::get('/bidang', Bidangs::class);
Route::get('/rak', \App\Http\Livewire\Raks::class);
Route::get('/box', \App\Http\Livewire\Boxs::class);
Route::get('/klasis', \App\Http\Livewire\Klasiss::class);
Route::get('/lembaga', \App\Http\Livewire\Lembagas::class);
Route::get('/lembagashow', \App\Http\Livewire\LembagaShows::class);


Route::get('/format', \App\Http\Livewire\Formats::class);
Route::get('/subBidang', \App\Http\Livewire\SubBidangs::class);
Route::get('/document', \App\Http\Livewire\Documents::class)->name('document');
Route::get('/master', \App\Http\Livewire\Masterdata::class)->name('master');

Route::get('/prasidang', \App\Http\Livewire\Prasidangs::class)->name('prasidang');
Route::get('/repoa', \App\Http\Livewire\RepoAs::class)->name('repoa');
Route::get('/repob', \App\Http\Livewire\RepoBs::class)->name('repob');
Route::get('/user', \App\Http\Livewire\Users::class)->name('user');





