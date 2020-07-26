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

Route::get('/', 'HomeController@index')->name('home');
Route::post('/upload-image', 'HomeController@uploadImage')->name('image.upload');
Route::get('/fetch-image', 'HomeController@fetchImage')->name('fetch.image');
Route::get('/delete-image', 'HomeController@deleteImage')->name('delete.image');
