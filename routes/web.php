<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

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
})->middleware(('guest'))->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->middleware(('guest'))->name('register');;

Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('register', [AuthController::class, 'register'])->name('auth.register');
});

Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('getKategori', [KategoriController::class, 'getKategori'])->name('kategori.getKategori');
    Route::post('storeKategori', [KategoriController::class, 'storeKategori'])->name('kategori.storeKategori');
    Route::post('updateKategori', [KategoriController::class, 'updateKategori'])->name('kategori.updateKategori');
    Route::post('deleteKategori', [KategoriController::class, 'deleteKategori'])->name('kategori.deleteKategori');
});

Route::group(['prefix' => 'produk'], function () {
    Route::get('/', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('getProduk', [ProdukController::class, 'getProduk'])->name('produk.getProduk');
    Route::post('storeProduk', [ProdukController::class, 'storeProduk'])->name('produk.storeProduk');
    Route::post('updateProduk', [ProdukController::class, 'updateProduk'])->name('produk.updateProduk');
    Route::post('deleteProduk', [ProdukController::class, 'deleteProduk'])->name('produk.deleteProduk');
});
