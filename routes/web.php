<?php

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



Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::group(['namespace' => 'Auth', 'prefix' => 'social'], function (){
    Route::get('/', 'RegisterController@getVKAccess')->name('register.getAccess');
    Route::get('/vk', 'RegisterController@registerByVk')->name('register.vk');
});
Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/catalog', function (){
    return view('catalog');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
