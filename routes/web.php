<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\CarsController;
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
Route::get('/exchange', [ConversionController::class, 'index'])->name('exchange');

Route::get('/scrape', [CarsController::class, 'gouttescrape'])->name('scrape');
Route::get('/scrape2', [CarsController::class, 'roachscrape'])->name('raochscrape');


// scrape iaa hiting node
Route::get('/scrape/iaaa', [CarsController::class, 'iaascrape'])->name('scrapeIaa');


// route for
Route::get('/trix', [BaseController::class, 'trix'])->name('trix');
Route::post('/trix', [BaseController::class, 'trixData'])->name('trix.data');


// route for learning more about blade components

Route::get('/component', function () {
    return view('component');
});
