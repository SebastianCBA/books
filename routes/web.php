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
Route::get('/upload', 'App\Http\Controllers\XmlController@index')->name('upload');
Route::post('/processupload', 'App\Http\Controllers\XmlController@processupload')->name('processupload');
Route::get('/crop', 'App\Http\Controllers\BookController@crop')->name('crop');
Route::get('/books', 'App\Http\Controllers\BookController@index')->name('index');
Route::get('/getbooks', 'App\Http\Controllers\BookController@books')->name('books');
Route::get('/getbooks/{key}', 'App\Http\Controllers\BookController@getbooks')->name('getbooks');


