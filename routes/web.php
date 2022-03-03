<?php

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversionController;

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

// route for testing  kudi
Route::get('/exchange',[ConversionController::class,'index'])->name('exchange');

// route for
Route::get('/trix',[BaseController::class,'trix'])->name('trix');
Route::post('/trix',[BaseController::class,'trixData'])->name('trix.data');

