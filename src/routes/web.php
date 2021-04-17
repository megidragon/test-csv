<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PageController;
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

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/upload', [PageController::class, 'upload'])->name('upload');
Route::get('/list', [PageController::class, 'list'])->name('list');
Route::get('/details/{sid}', [PageController::class, 'details'])->name('details');

Route::post('/set-role', [PageController::class, 'setRole'])->name('set-role');
Route::post('/upload-file', [FileController::class, 'uploadCsv'])->name('upload-file');
