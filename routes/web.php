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
    Route::get('/', 'RegisterController@getSocialAccess')->name('register.getAccess');
    Route::get('/vk/reg', 'RegisterController@registerByVk')->name('register.vk');
    Route::get('/fb/reg', 'RegisterController@registerByFb')->name('register.fb');
    Route::get('/vk/login', 'LoginController@loginByVk')->name('login.vk');
    Route::get('/fb/login', 'LoginController@loginByFb')->name('login.fb');
});
Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/catalog', function (){
    return view('catalog');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
