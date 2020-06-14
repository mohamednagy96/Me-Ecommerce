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
define('PAGINATION_COUNT',10);

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    /**
     * language
     */
    Route::resource('languages','LanguageController');
    // Route::group(['prefix' =>'languages'],function(){
    //     // Route::get('/','LanguageController');
    // });
});


Route::group([ 'middleware' => 'guest:admin'], function () {
    Route::get('login', 'LoginController@getLogin')->name('get.login');
    Route::post('login', 'LoginController@Login')->name('login');
});