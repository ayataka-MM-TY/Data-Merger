<?php

use App\Http\Controllers\ConfirmController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\UploadController;
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

Route::get('/', [UploadController::class, 'show']);

Route::post('/confirm', [ConfirmController::class, 'confirm']);

Route::get('/download', [DownloadController::class, 'show']);

Route::post('/download', [DownloadController::class, 'saveOrCancel']);
