<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/getqr',[PostController::class,'index']);
Route::get('/getqrtoday',[PostController::class,'showhariini']);
Route::get('/getalluser',[PostController::class,'getalluser']);//buat kupon
Route::get('/deleteallqr',[PostController::class,'deleteallqr']);
Route::post('/qrdelete/{qr}',[PostController::class,'destroy']);

Route::get('/getallsantri',[AuthenticationController::class,'getallsantri']);
Route::post('/register',[AuthenticationController::class,'register']);
Route::post('/deleteuser/{id}',[AuthenticationController::class,'deleteuser']);