<?php

use App\Http\Controllers\BeetwenController;
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
    return view('welcome');
});

Route::get('/cari', [BeetwenController::class, 'index']);
Route::get('/wherebulantahun', [BeetwenController::class, 'wherebulantahun']);

Route::get('/pdf', [BeetwenController::class, 'pdf']);
Route::get('/excel', [BeetwenController::class, 'excelexport']);
Route::post('/excel', [BeetwenController::class, 'excelimport']);
