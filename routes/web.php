<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\PemeriksaanController;
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

//log
Route::get('/',[LoginController::class,'index']);
Route::post('/loginproses',[LoginController::class,'proses']);
Route::get('/login/logout',[LoginController::class,'logout']);
Route::get('/dashboard',[DashboardController::class,'index']);

Route::get('/pasien',[PasienController::class,'list']);
Route::post('/pasien/update',[PasienController::class,'update']);
Route::get('/pasien/edit/{id}',[PasienController::class,'edit']);
Route::get('/pasien/add',[PasienController::class,'add']);
Route::post('/pasien/save',[PasienController::class,'save']);
Route::get('/pasien/delete/{id}',[PasienController::class,'delete']);
Route::get('/pasien/cetak/{id}',[PasienController::class,'cetakkartu']);

Route::get('/pengguna',[PenggunaController::class,'list']);
Route::post('/pengguna/update',[PenggunaController::class,'update']);
Route::get('/pengguna/edit/{id}',[PenggunaController::class,'edit']);
Route::get('/pengguna/add',[PenggunaController::class,'add']);
Route::post('/pengguna/save',[PenggunaController::class,'save']);
Route::get('/pengguna/delete/{id}',[PenggunaController::class,'delete']);

Route::get('/obat',[ObatController::class,'list']);
Route::post('/obat/update',[ObatController::class,'update']);
Route::get('/obat/edit/{id}',[ObatController::class,'edit']);
Route::get('/obat/add',[ObatController::class,'add']);
Route::post('/obat/save',[ObatController::class,'save']);
Route::get('/obat/delete/{id}',[ObatController::class,'delete']);


Route::get('/registrasi/{id?}',[RegistrasiController::class,'list']);
Route::post('/registrasi/update',[RegistrasiController::class,'update']);
Route::get('/registrasi/edit/{id}',[RegistrasiController::class,'edit']);
Route::get('/registrasi/add',[RegistrasiController::class,'add']);
Route::post('/registrasi/save',[RegistrasiController::class,'save']);
Route::get('/registrasi/delete/{id}',[RegistrasiController::class,'delete']);


Route::get('/pemeriksaanperawat/{id}',[PemeriksaanController::class,'pemeriksaanPerawat']);
Route::post('/pemeriksaanperawat/save',[PemeriksaanController::class,'savePemeriksaanPerawat']);
Route::get('/pemeriksaandokter/{id}',[PemeriksaanController::class,'pemeriksaanDokter']);
Route::post('/pemeriksaandokter/save',[PemeriksaanController::class,'savePemeriksaanDokter']);