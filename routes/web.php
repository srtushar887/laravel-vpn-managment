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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function (){
   Route::get('/login','Auth\AdminLoginController@showloginfrom')->name('admin.login');
   Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');

   Route::get('/logout','Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::group(['middleware'=>['auth:admin']],function (){
   Route::prefix('admin')->group(function (){
       Route::get('/','AdminController@index')->name('admin.dashboard');


       //sub administrator
       Route::get('sub-administrator','AdminUserNavigationController@sub_administrator')->name('admin.sub.administratio');
       Route::post('sub-administrator','AdminUserNavigationController@sub_administrator_save')->name('sub.administrator.create');
       Route::post('sub-administrator-edit','AdminUserNavigationController@sub_administrator_edit')->name('sub.administrator.update');
       Route::post('sub-administrator-delete','AdminUserNavigationController@sub_administrator_delete')->name('sub.administrator.delete');


       //reseller
       Route::get('reseller','AdminUserNavigationController@reseller')->name('admin.reseller');
       Route::post('reseller','AdminUserNavigationController@reseller_create')->name('admin.reseller.create');
       Route::post('reseller-edit','AdminUserNavigationController@reseller_edit')->name('admin.reseller.update');
       Route::post('reseller-delete','AdminUserNavigationController@reseller_delete')->name('admin.reseller.delete');


       //reseller
       Route::get('sub-reseller','AdminUserNavigationController@sub_reseller')->name('admin.sub.reseller');
       Route::post('sub-reseller','AdminUserNavigationController@sub_reseller_create')->name('admin.subreseller.create');
       Route::post('sub-reseller-edit','AdminUserNavigationController@sub_reseller_edit')->name('admin.subreseller.update');
       Route::post('sub-reseller-delete','AdminUserNavigationController@sub_reseller_delete')->name('admin.subreseller.delete');



   });
});

