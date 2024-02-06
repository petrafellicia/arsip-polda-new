<?php

use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\GrafikController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LoginController;

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
    return view('depan');
});
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');

Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth', 'hakakses:admin,operator']], function () {


    // Route::get('/home', function () {
    //     return view('home', [
    //         "title" => "Home"
    //     ]);
    // });

    Route::get('/home', [GrafikController::class, 'grafikSurat']);
    //   Route::post('/sync-monthly-data', [GrafikController::class, 'syncMonthlyData']);


    Route::get('/mails', [MailController::class, 'index']);

    // halaman surat
    Route::get('/mails/{slug}', [MailController::class, 'show']);

    Route::get('/daftar-surat-masuk', [SuratMasukController::class, 'index'])->name('daftar-surat-masuk');
    Route::get('/daftar-surat-masuk/search', [SuratMasukController::class, 'cari'])->name('daftar-surat-masuk');
    Route::get('/daftar-surat-keluar/search', [SuratKeluarController::class, 'cari'])->name('daftar-surat-keluar');
    Route::get('/masuk', [SuratMasukController::class, 'tambahdata']);
    Route::post('/insertsurat', [SuratMasukController::class, 'insertsurat'])->name('insertsurat');
    Route::get('/download{file}', [SuratMasukController::class, 'download']);
    Route::get('/download{file}', [SuratKeluarController::class, 'download']);

    Route::get('/daftar-surat-keluar', [SuratKeluarController::class, 'index'])->name('daftar-surat-keluar');

    Route::get('/keluar', [SuratKeluarController::class, 'tambahsuratkeluar'])->name('tambahsuratkeluar');

    Route::post('/insertsuratkeluar', [SuratKeluarController::class, 'insertsuratkeluar'])->name('insertsuratkeluar');

    Route::get('/scan', [ScanController::class, 'index']);
    Route::post('/scan', [ScanController::class, 'scan']);

});

Route::group(['middleware' => ['auth', 'hakakses:admin']], function () {
    Route::get('/tampilkandatamasuk/{id}', [SuratMasukController::class, 'tampilkandatamasuk'])->name('tampilkandatamasuk');
    Route::post('/updatedatamasuk/{id}', [SuratMasukController::class, 'updatedatamasuk'])->name('updatedatamasuk');

    Route::get('/tampilkandatakeluar/{id}', [SuratKeluarController::class, 'tampilkandatakeluar'])->name('tampilkandatakeluar');
    Route::post('/updatedatakeluar/{id}', [SuratKeluarController::class, 'updatedatakeluar'])->name('updatedatakeluar');

    Route::get('/deletemasuk/{id}', [SuratMasukController::class, 'deletemasuk'])->name('deletemasuk');
    Route::get('/deletekeluar/{id}', [SuratKeluarController::class, 'deletekeluar'])->name('deletekeluar');
    Route::get('/deletefilemasuk/{id}', [SuratMasukController::class, 'destroy'])->name('deletefilemasuk');
    Route::get('/deletefilekeluar/{id}', [SuratKeluarController::class, 'destroy'])->name('deletefilekeluar');


    //exportpdf
    Route::get('/pilih-bulan-masuk', [SuratMasukController::class, 'showForm'])->name('pilih-bulan-masuk');
    Route::post('/exportpdfmasuk', [SuratMasukController::class, 'exportpdfmasuk'])->name('exportpdfmasuk');
    Route::get('/pilih-bulan-keluar', [SuratKeluarController::class, 'showForm'])->name('pilih-bulan-keluar');
    Route::post('/exportpdfkeluar', [SuratKeluarController::class, 'exportpdfkeluar'])->name('exportpdfkeluar');
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "name" => "Alfrina - Petra",
    ]);
});
