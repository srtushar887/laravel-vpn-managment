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
    return view('welcome-new');
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
       Route::get('create-sub-administrator','AdminUserNavigationController@create_sub_administrator')->name('create.subadmin');
       Route::post('sub-administrator','AdminUserNavigationController@sub_administrator_save')->name('sub.administrator.create');
       Route::get('sub-administrator-edit/{id}','AdminUserNavigationController@sub_administrator_edit_data')->name('sub.admin.edit');
       Route::post('sub-administrator-edit-data','AdminUserNavigationController@sub_administrator_edit')->name('sub.administrator.update');
       Route::post('sub-administrator-delete','AdminUserNavigationController@sub_administrator_delete')->name('sub.administrator.delete');
       Route::get('sub-administrator-change-permision/{id}','AdminUserNavigationController@sub_administrator_chnage_permision')->name('admin.subadminis.chnageper');
       Route::post('sub-administrator-change-permision','AdminUserNavigationController@sub_administrator_chnage_permision_save')->name('sub.administrator.chnage.permision.save');
       Route::post('sub-administrator-block','AdminUserNavigationController@sub_administrator_block')->name('admin.subadminis.block');


       //reseller
       Route::get('reseller','AdminUserNavigationController@reseller')->name('admin.reseller');
       Route::get('create-reseller','AdminUserNavigationController@create_reseller')->name('craete.reseller');
       Route::post('reseller','AdminUserNavigationController@reseller_create')->name('admin.reseller.create');
       Route::get('reseller-edit/{id}','AdminUserNavigationController@reseller_edit_data')->name('reseller.edit');
       Route::post('reseller-edit-data','AdminUserNavigationController@reseller_edit')->name('admin.reseller.update');
       Route::post('reseller-delete','AdminUserNavigationController@reseller_delete')->name('admin.reseller.delete');
       Route::get('reseller-permission-change/{id}','AdminUserNavigationController@reseller_permission_chnage')->name('admin.reseller.chnageper');
       Route::post('reseller-permission-change','AdminUserNavigationController@reseller_permission_chnage_save')->name('sub.reseller.chnage.permision.save');
       Route::post('reseller-block','AdminUserNavigationController@reseller_block')->name('admin.reseller.block');


       //reseller
       Route::get('sub-reseller','AdminUserNavigationController@sub_reseller')->name('admin.sub.reseller');
       Route::get('create-sub-reseller','AdminUserNavigationController@sub_reseller_create_new')->name('create.subreseller');
       Route::post('sub-reseller','AdminUserNavigationController@sub_reseller_create')->name('admin.subreseller.create');
       Route::get('sub-reseller-edit/{id}','AdminUserNavigationController@sub_reseller_edit_data')->name('sub.reseller.edit');
       Route::post('sub-reseller-edit-data','AdminUserNavigationController@sub_reseller_edit')->name('admin.subreseller.update');
       Route::post('sub-reseller-delete','AdminUserNavigationController@sub_reseller_delete')->name('admin.subreseller.delete');
       Route::get('sub-reseller-permission-change/{id}','AdminUserNavigationController@sub_reseller_permission_chnage')->name('admin.subreseller.chnageper');
       Route::post('sub-reseller-permission-change','AdminUserNavigationController@sub_reseller_permission_chnage_save')->name('sub.subreseller.chnage.permision.save');
       Route::post('sub-reseller-block','AdminUserNavigationController@sub_reseller_block')->name('admin.subreseller.block');

       //create vpn
       Route::get('create-quick-user','AdminUserNavigationController@create_quick_user')->name('admin.create.quick.user');
       Route::post('create-quick-user','AdminUserNavigationController@create_quick_user_save')->name('admin.quieck.user.save');
       Route::post('sub-reseller-edit','AdminUserNavigationController@sub_reseller_edit')->name('admin.subreseller.update');
       Route::post('sub-reseller-delete','AdminUserNavigationController@sub_reseller_delete')->name('admin.subreseller.delete');






   });
});

