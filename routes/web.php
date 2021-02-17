<?php

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

});

Auth::routes();

Route::get('/homeip', [App\Http\Controllers\HomeController::class, 'ipp'])->name('ip');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('blogs',\App\Http\Controllers\BlogController::class);

Route::post('ckeditor/image_upload', [App\Http\Controllers\CKEditorController::class, 'upload'])->name('upload');

Route::get('/geoip', function (){
    $geoipInfo = geoip()->getLocation('93.183.226.246');
    return $geoipInfo->toArray();
});

