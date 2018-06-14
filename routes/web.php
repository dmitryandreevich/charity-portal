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

Route::post('/ajax-login', 'Auth\LoginController@ajaxLogin')->name('login.ajax');
Route::post('/ajax-register', 'Auth\RegisterController@ajaxRegister')->name('register.ajax');
// Profile group
Route::group(['namespace' => 'Profile', 'prefix' => 'pr', 'middleware' => 'auth'],function (){
   Route::get('/', 'MainController@index')->name('profile.index');
   Route::post('/update','MainController@update')->name('profile.update');
   Route::get('/vk-attach', 'SocialController@vkAttach')->name('profile.vkAttach');
   Route::get('/fb-attach', 'SocialController@fbAttach')->name('profile.fbAttach');
   Route::post('/change-password','ChangePasswordController@update')->name('profile.changePassword');
   Route::post('/toggleStatus', 'MainController@toggle')->name('profile.toggleStatus');
   Route::post('/change-avatar', 'AvatarController@store')->name('profile.changeAvatar.store');
});
// Обработка пожертвования донорами
Route::post('/donation', 'Profile\DonorController@donation')->name('donation.store')->middleware(['auth','donor']);
// Добавить волонтёра к потребности
Route::get('/add-volunteer/{need}', 'Profile\VolunteerController@addVolunteer')->name('volunteer.add')->middleware(['auth','volunteer']);
Route::post('/add-volunteers', 'Profile\VolunteerController@addVolunteers')->name('volunteers.add')->middleware(['auth','volunteer']);;
// Catalog
Route::group(['prefix' => 'catalog'], function (){
   Route::get('/', 'CatalogController@index')->name('catalog.index');
   Route::put('/filter', 'CatalogController@sort')->name('catalog.sort');
});

Route::resource('/organizations', 'OrganizationController', ['except' => 'show']);
Route::get('/organizations/{organization}', 'OrganizationController@show')->name('organizations.show');
Route::get('/organizations/archive/{organization}', 'ArchiveController@index')->name('organizations.archive.index');
Route::post('/organizations/filter', 'OrganizationController@filter')->name('organizations.show.filter');
Route::group(['namespace' => 'Need'], function (){
    Route::resource('/needs', 'NeedController');
    Route::post('/needs/sorting', 'SortingController@show')->name('needs.sorting.show');
    Route::post('cancel-need', 'CancelNeedController@store')->name('needs.cancel.store')->middleware(['auth','consumer']);
    Route::post('/send-report', 'SendReportController@store')->name('needs.report.store')->middleware('auth');
    Route::post('/request-withdraw/{need}', 'WithdrawMoneyController@store')->name('needs.withdraw.store')->middleware(['auth','consumer']);
});

Route::get('/', 'HomeController@index')->name('home.index');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard', 'middleware' => 'auth'], function(){
    Route::get('/', function (){
        return redirect(route('dashboard.users.index'));
    });
    Route::get('/organizations', 'OrganizationsController@index')->name('dashboard.organizations.index')->middleware('checkAdminRules:admin');
    Route::get('/needs', 'NeedsController@index')->name('dashboard.needs.index')->middleware('checkAdminRules:admin,moderator');
    Route::get('/users', 'UsersController@index')->name('dashboard.users.index')->middleware('checkAdminRules:admin');
    Route::get('/users/{user}', 'UsersController@show')->name('dashboard.users.show')->middleware('checkAdminRules:admin,moderator');
    Route::get('/payments', 'PaymentsController@index')->name('dashboard.payments.index')->middleware('checkAdminRules:admin');
    Route::get('/moderation', 'ModerationController@index')->name('dashboard.moderation.index')->middleware('checkAdminRules:admin,moderator');

    Route::post('/reset-password/{user}', 'ResetPasswordController@store')->name('dashboard.users.reset')->middleware('checkAdminRules:admin');

    // org apply/block/unblock
    Route::get('/org-apply/{organization}', 'ModerationController@orgApply')->name('dashboard.moderation.org.apply')->middleware('checkAdminRules:admin');
    Route::post('/org-block', 'ModerationController@orgBlock')->name('dashboard.moderation.org.block')->middleware('checkAdminRules:admin');
    Route::get('/org-unblock/{organization}', 'ModerationController@orgUnBlock')->name('dashboard.moderation.org.unblock')->middleware('checkAdminRules:admin');
    // need block/unblock reports delete
    Route::get('/need-report-delete/{report}', 'ModerationController@reportDelete')->name('dashboard.moderation.need.report.delete')->middleware('checkAdminRules:admin,moderator');
    Route::post('/need-block', 'ModerationController@needBlock')->name('dashboard.moderation.need.block')->middleware('checkAdminRules:admin,moderator');
    Route::get('/need-unblock/{need}', 'ModerationController@needUnBlock')->name('dashboard.moderation.need.unblock')->middleware('checkAdminRules:admin,moderator');
    //
    Route::post('/search', 'SearchController@search')->name('dashboard.search')->middleware('checkAdminRules:admin,moderator');
});
Route::get('/mark-withdraw/{id}', 'Need\WithdrawMoneyController@markWithdraw')->name('dashboard.withdraw.mark')->middleware('checkAdminRules:admin');

