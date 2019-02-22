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
       Route::post('sub-administrator-unblock','AdminUserNavigationController@sub_administrator_unblock')->name('admin.subadminis.unblock');


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
       Route::post('reseller-unblock','AdminUserNavigationController@reseller_unblock')->name('admin.reseller.unblock');


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
       Route::post('sub-reseller-unblock','AdminUserNavigationController@sub_reseller_unblock')->name('admin.subreseller.unblock');



       //free user
       Route::get('free-user','AdminUserNavigationController@free_user')->name('admin.freeuser');
       Route::get('create-free-user','AdminUserNavigationController@create_free_user')->name('create.free.user');
       Route::post('create-free-user','AdminUserNavigationController@create_free_user_store')->name('free.user.store');
       Route::get('free-user-edit/{id}','AdminUserNavigationController@free_user_edit_data')->name('free.user.edit');
       Route::post('free-user-edit-data','AdminUserNavigationController@free_user_edit')->name('admin.free.user.update');
       Route::post('free-user-delete','AdminUserNavigationController@free_user_delete')->name('free.user.delete');
       Route::get('free-user-permission-change/{id}','AdminUserNavigationController@free_user_permission_chnage')->name('admin.freeuser.chnageper');
       Route::post('free-user-permission-change','AdminUserNavigationController@free_user_permission_chnage_save')->name('freeuser.chnage.permision.save');
       Route::post('free-user-block','AdminUserNavigationController@free_user_block')->name('admin.free.user.block');
       Route::post('free-user-unblock','AdminUserNavigationController@free_user_unblock')->name('admin.free.user.unblock');


       //create vpn
       Route::get('create-quick-user','AdminUserNavigationController@create_quick_user')->name('admin.create.quick.user');
       Route::post('create-quick-user','AdminUserNavigationController@create_quick_user_save')->name('admin.quieck.user.save');

       //bulk user
       Route::get('bulk-user','AdminUserNavigationController@bulk_user')->name('admin.bulk.user');
       Route::post('bulk-user','AdminUserNavigationController@bulk_user_save')->name('bulk.user.store');

       //add credit
       Route::get('add-credit','AdminUserNavigationController@add_credit')->name('admin.credit');
       Route::post('sub-administrator-credit-add','AdminUserNavigationController@sub_adminstrator_credit_add')->name('admin.subadmintator.credit.add');




   });
});

