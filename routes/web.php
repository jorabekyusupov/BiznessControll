<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\PictureController;
use App\Http\Controllers\Master\FileController;

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

//Route::get('/', function () {
//    echo 'welcome';
//});

Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');

Route::get('/picture/{id}', [PictureController::class, 'getPicture'])->name('picture.get-picture');
Route::get('/file/{id}', [FileController::class, 'show'])->name('file.get-file');
