<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InitController;
use App\Http\Controllers\BlogEntryController;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\MyFormController;
use App\Http\Controllers\MyAppController;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/init', 'App\Http\Controllers\InitController@index');

Route::get('/blog', 'App\Http\Controllers\BlogEntryController@index');

Route::get('/blog/{blogentry}', 'App\Http\Controllers\BlogEntryController@show');

Route::get('/buy-rent', 'App\Http\Controllers\GoodController@index');

Route::get('/object/{good}', 'App\Http\Controllers\GoodController@show');

Route::get('/pages', 'App\Http\Controllers\PageController@index');

Route::get('/pages/{page}', 'App\Http\Controllers\PageController@show');

Route::post('/send', 'App\Http\Controllers\MyFormController@store')->name('send');

Route::post('/app', 'App\Http\Controllers\MyAppController@store')->name('app');








