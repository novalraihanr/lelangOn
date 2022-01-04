<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\userController;
use App\Http\Controllers\masyarakatController;
use App\Http\Controllers\petugasController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\lelangController;
use App\Http\Controllers\HlelangController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);

Route::post('transaksi/store',[TransaksiController::class,'store']);
Route::get('transaksi',[TransaksiController::class,'index']);
Route::put('transaksi/update',[TransaksiController::class,'update']);
Route::delete('transaksi/delete',[TransaksiController::class,'destroy']);


Route::group(['middleware' => ['jwt.verify:admin,masyarakat']], function()
{
    //ROUTE KHUSUS ADMIN DAN MASYARAKAT
    Route::post('user/add',[userController::class,'store']);
});

Route::group(['middleware' => ['jwt.verify:admin,petugas']], function()
{
    //ROUTE KHUSUS ADMIN DAN PETUGAS
    Route::get('login/check',[AuthController::class,'loginCheck']);
    
    Route::post('barang/store',[barangController::class,'store']);
    Route::get('barang',[barangController::class,'index']);
    Route::get('barang/{id}',[barangController::class,'show']);
    Route::put('barang/update',[barangController::class,'update']);
    Route::delete('barang/delete',[barangController::class,'destroy']);
});

Route::group(['middleware' => ['jwt.verify:masyarakat']], function()
{
    Route::post('hlelang/store',[HlelangController::class,'store']);
    Route::get('hlelang',[HlelangController::class,'index']);
    Route::put('hlelang/update',[HlelangController::class,'update']);
    Route::delete('hlelang/delete',[HlelangController::class,'destroy']);
});

Route::group(['middleware' => ['jwt.verify:petugas']], function()
{
    //ROUTE KHUSUS PETUGAS
    Route::post('lelang/store',[lelangController::class,'store']);
    Route::get('lelang',[lelangController::class,'index']);
    Route::put('lelang/update',[lelangController::class,'update']);
    Route::delete('lelang/delete',[lelangController::class,'destroy']);

    Route::post('transaksi/store',[TransaksiController::class,'store']);
    Route::get('transaksi',[TransaksiController::class,'index']);
    Route::put('transaksi/update',[TransaksiController::class,'update']);
    Route::delete('transaksi/delete',[TransaksiController::class,'destroy']);
});

Route::group(['middleware' => ['jwt.verify:admin']], function()
{
    //ROUTE KHUSUS ADMIN
    Route::get('index',[userController::class,'show']);

    Route::post('petugas/store',[petugasController::class,'store']);
    Route::get('petugas',[petugasController::class,'index']);
    Route::put('petugas/update',[petugasController::class,'update']);
    Route::delete('petugas/delete',[petugasController::class,'destroy']);

    Route::post('masyarakat/store',[masyarakatController::class,'store']);
    Route::get('masyarakat',[masyarakatController::class,'index']);
    Route::get('masyarakat/{id}',[barangController::class,'show']);
    Route::put('masyarakat/update',[masyarakatController::class,'update']);
    Route::delete('masyarakat/delete',[masyarakatController::class,'destroy']);
});