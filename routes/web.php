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

Route::group(['namespace' => 'Auth', 'prefix' => 'social', 'middleware' => 'guest'], function (){
    Route::get('/', 'RegisterController@getSocialAccess')->name('register.getAccess');
    Route::get('/vk/reg', 'RegisterController@registerByVk')->name('register.vk');
    Route::get('/fb/reg', 'RegisterController@registerByFb')->name('register.fb');
    Route::get('/vk/login', 'LoginController@loginByVk')->name('login.vk');
    Route::get('/fb/login', 'LoginController@loginByFb')->name('login.fb');
});
// Profile group
Route::group(['namespace' => 'Profile', 'prefix' => 'pr', 'middleware' => 'auth'],function (){
   Route::get('/', 'MainController@index')->name('profile.index');
   Route::post('/update','MainController@update')->name('profile.update');
   Route::get('/vk-attach', 'SocialController@vkAttach')->name('profile.vkAttach');
   Route::get('/fb-attach', 'SocialController@fbAttach')->name('profile.fbAttach');
   Route::post('/change-password','ChangePasswordController@update')->name('profile.changePassword');
   Route::post('/toggleStatus', 'MainController@toggle')->name('profile.toggleStatus');
   //Route::get('/{user}', 'ShowController@show')->name('profile.show');
});
// Обработка пожертвования донорами
Route::post('/donation', 'Profile\DonorController@donation')->name('donation.store');
// Добавить волонтёра к потребности
Route::get('/add-volunteer/{need}', 'Profile\VolunteerController@addVolunteer')->name('volunteer.add');
Route::post('/add-volunteers', 'Profile\VolunteerController@addVolunteers')->name('volunteers.add');
// Catalog
Route::group(['prefix' => 'catalog'], function (){
   Route::get('/', 'CatalogController@index')->name('catalog.index');
   Route::put('/sort', 'CatalogController@sort')->name('catalog.sort');

});
Route::resource('/organizations', 'OrganizationController', ['except' => 'show']);
Route::get('/organizations/{organization}', 'OrganizationController@show')->name('organizations.show');
Route::get('/organizations/archive/{organization}', 'ArchiveController@index')->name('organizations.archive.index');

Route::group(['namespace' => 'Need'], function (){
    Route::resource('/needs', 'NeedController');
    Route::post('/needs/sorting', 'SortingController@show')->name('needs.sorting.show');
    Route::post('cancel-need', 'CancelNeedController@store')->name('needs.cancel.store');
});

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/home', 'HomeController@index')->name('home');
