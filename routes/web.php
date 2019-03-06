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
       Route::post('sub-administrator-add-cradit','AdminUserNavigationController@sub_administrator_add_cradit')->name('sub.administrator.add.credit.bal');
       Route::post('sub-administrator-search','AdminUserNavigationController@sub_administrator_search')->name('admin.subadmin.search');
       Route::post('sub-administrator-time-search','AdminUserNavigationController@sub_administrator_time_search')->name('admin.subadmin.time.search');
       Route::post('sub-administrator-cradit-search','AdminUserNavigationController@sub_administrator_cradit_search')->name('admin.sibadmin.cradit.search');


       //reseller
       Route::get('reseller','AdminUserNavigationController@reseller')->name('admin.reseller');
       Route::get('create-reseller','AdminUserNavigationController@create_reseller')->name('craete.reseller');
       Route::post('reseller','AdminUserNavigationController@reseller_create')->name('admin.reseller.create');
       Route::get('reseller-edit/{id}','AdminUserNavigationController@reseller_edit_data')->name('admin.reseller.edit');
       Route::post('reseller-edit-data','AdminUserNavigationController@reseller_edit')->name('admin.reseller.update');
       Route::post('reseller-delete','AdminUserNavigationController@reseller_delete')->name('admin.reseller.delete');
       Route::get('reseller-permission-change/{id}','AdminUserNavigationController@reseller_permission_chnage')->name('admin.reseller.chnageper');
       Route::post('reseller-permission-change','AdminUserNavigationController@reseller_permission_chnage_save')->name('sub.reseller.chnage.permision.save');
       Route::post('reseller-block','AdminUserNavigationController@reseller_block')->name('admin.reseller.block');
       Route::post('reseller-unblock','AdminUserNavigationController@reseller_unblock')->name('admin.reseller.unblock');
       Route::post('reseller-add-cradit','AdminUserNavigationController@reseller_add_cradit')->name('reseller.add.credit.bal');
       Route::post('reseller-search','AdminUserNavigationController@reseller_search')->name('admin.reseller.search');
       Route::post('reseller-time-search','AdminUserNavigationController@reseller_time_search')->name('admin.reseller.time.search');
       Route::post('reseller-cradit-search','AdminUserNavigationController@reseller_cradit_search')->name('admin.reseller.cradit.search');


       //sub-reseller
       Route::get('sub-reseller','AdminUserNavigationController@sub_reseller')->name('admin.sub.reseller');
       Route::get('create-sub-reseller','AdminUserNavigationController@sub_reseller_create_new')->name('create.subreseller');
       Route::post('sub-reseller','AdminUserNavigationController@sub_reseller_create')->name('admin.subreseller.create');
       Route::get('sub-reseller-edit/{id}','AdminUserNavigationController@sub_reseller_edit_data')->name('admin.sub.reseller.edit');
       Route::post('sub-reseller-edit-data','AdminUserNavigationController@sub_reseller_edit')->name('admin.subreseller.update');
       Route::post('sub-reseller-delete','AdminUserNavigationController@sub_reseller_delete')->name('admin.subreseller.delete');
       Route::get('sub-reseller-permission-change/{id}','AdminUserNavigationController@sub_reseller_permission_chnage')->name('admin.subreseller.chnageper');
       Route::post('sub-reseller-permission-change','AdminUserNavigationController@sub_reseller_permission_chnage_save')->name('sub.subreseller.chnage.permision.save');
       Route::post('sub-reseller-block','AdminUserNavigationController@sub_reseller_block')->name('admin.subreseller.block');
       Route::post('sub-reseller-unblock','AdminUserNavigationController@sub_reseller_unblock')->name('admin.subreseller.unblock');
       Route::post('sub-reseller-add-cradit','AdminUserNavigationController@sub_reseller_add_cradit')->name('subreseller.add.credit.bal');
       Route::post('sub-reseller-search','AdminUserNavigationController@sub_reseller_search')->name('admin.subreseller.search');
       Route::post('sub-reseller-time-search','AdminUserNavigationController@sub_reseller_time_search')->name('admin.subreseller.time.search');
       Route::post('sub-reseller-cradit-search','AdminUserNavigationController@sub_reseller_cradit_search')->name('admin.subreseller.cradit.search');



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
       Route::post('free-user-add-cradit','AdminUserNavigationController@free_user_add_cradit')->name('freeuser.add.credit.bal');
       Route::post('free-user-search','AdminUserNavigationController@free_user_search')->name('admin.freeuser.search');


       //create vpn
       Route::get('create-quick-user','AdminUserNavigationController@create_quick_user')->name('admin.create.quick.user');
       Route::post('create-quick-user','AdminUserNavigationController@create_quick_user_save')->name('admin.quieck.user.save');

       //bulk user
       Route::get('bulk-user','AdminUserNavigationController@bulk_user')->name('admin.bulk.user');
       Route::post('bulk-user','AdminUserNavigationController@bulk_user_save')->name('bulk.user.store');

       //add credit
       Route::get('add-credit','AdminUserNavigationController@add_credit')->name('admin.credit');
       Route::post('sub-administrator-credit-add','AdminUserNavigationController@sub_adminstrator_credit_add')->name('admin.subadmintator.credit.add');
       Route::get('reseller-credit-add','AdminUserNavigationController@reseller_credit')->name('admin.credit.reseller');
       Route::post('reseller-credit-add','AdminUserNavigationController@reseller_credit_save')->name('admin.reseller.credit.add');
       Route::get('sub-reseller-credit-add','AdminUserNavigationController@subreseller_credit')->name('admin.credit.subreseller.add');
       Route::post('sub-reseller-credit-add','AdminUserNavigationController@subreseller_credit_save')->name('admin.subreseller.credit.add');


       //time duration
       Route::get('add-sub-administration-time-duration','AdminUserNavigationController@sub_ad_time_duration')->name('admin.time.duration');
       Route::get('add-sub-administration-time-duration-select/{id}','AdminUserNavigationController@sub_ad_time_duration_select')->name('sub.admin.timedur');
       Route::post('add-sub-administration-time-duration-select','AdminUserNavigationController@sub_ad_time_duration_select_save')->name('subadmin.time.save');
       Route::get('add-reseller-time-duration','AdminUserNavigationController@reseller_time_duration')->name('admin.reseller.time.duration');
       Route::get('add-reseller-time-duration-select/{id}','AdminUserNavigationController@reseller_time_duration_select')->name('reseller.timedur');
       Route::post('add-reseller-time-duration-select','AdminUserNavigationController@reseller_time_duration_select_save')->name('reseller.time.save');
       Route::get('add-sub-reseller-time-duration','AdminUserNavigationController@subreseller_time_duration')->name('admin.subreseller.time.duration');
       Route::get('add-sub-reseller-time-duration-select/{id}','AdminUserNavigationController@subreseller_time_duration_select')->name('subreseller.timedur');
       Route::post('add-sub-reseller-time-duration-select','AdminUserNavigationController@subreseller_time_duration_select_save')->name('subreseller.time.save');

       //all user
       Route::get('all-user','AdminUserNavigationController@all_user')->name('admin.all.user');


   });
});



Route::prefix('administrator')->group(function (){
    Route::get('/login','Auth\AdministratorLoginController@showloginfrom')->name('administrator.login');
    Route::post('/login','Auth\AdministratorLoginController@login')->name('administrator.login.submit');

    Route::get('/logout','Auth\AdministratorLoginController@logout')->name('administrator.logout');
});

Route::group(['middleware'=>['auth:administrator']],function (){
    Route::prefix('administrator')->group(function (){

        Route::get('/','AdministratorController@index')->name('administrator.dashboard');

        Route::get('reseller','AdministratorDataController@reseller')->name('administrator.reseller');
        Route::get('create-reseller','AdministratorDataController@reseller_create')->name('craete.administrator.reseller');
        Route::post('create-reseller','AdministratorDataController@reseller_save')->name('administrator.reseller.save');
        Route::get('edit-reseller/{id}','AdministratorDataController@reseller_edit')->name('reseller.edit');
        Route::post('edit-reseller','AdministratorDataController@reseller_update')->name('administrator.reseller.update');
        Route::post('delete-reseller','AdministratorDataController@reseller_delete')->name('administrator.reseller.delete');
        Route::get('change-permission/{id}','AdministratorDataController@reseller_change_permisiion')->name('administrator.reseller.chnageper');
        Route::post('change-permission','AdministratorDataController@reseller_change_permisiion_save')->name('reseller.chnage.permision.save');
        Route::post('change-block','AdministratorDataController@reseller_change_block')->name('adminstrator.reseller.block');
        Route::post('change-unblock','AdministratorDataController@reseller_change_unblock')->name('adminstrator.reseller.unblock');
        Route::post('reseller-cradit-add','AdministratorDataController@reseller_cradit_add')->name('adminstrator.reseller.add.credit.bal');

        //sub reseller
        Route::get('sub-reseller','AdministratorDataController@sub_reseller')->name('administrator.sub.reseller');
        Route::get('create-sub-reseller','AdministratorDataController@sub_reseller_create')->name('create.subreseller');
        Route::post('create-sub-reseller','AdministratorDataController@sub_reseller_save')->name('administrator.subreseller.create');
        Route::get('edit-sub-reseller/{id}','AdministratorDataController@sub_reseller_edit')->name('sub.reseller.edit');
        Route::post('edit-sub-reseller','AdministratorDataController@sub_reseller_update')->name('administrator.subreseller.update');
        Route::get('sub-reseller-change-permission/{id}','AdministratorDataController@sub_reseller_cahnage_permission')->name('adminstrator.subreseller.chnageper');
        Route::post('sub-reseller-change-permission','AdministratorDataController@sub_reseller_cahnage_permission_save')->name('administrator.subreseller.chnage.permision.save');
        Route::post('sub-reseller-delete','AdministratorDataController@sub_reseller_delete')->name('adminstrator.subreseller.delete');
        Route::post('sub-reseller-block','AdministratorDataController@sub_reseller_block')->name('adminstrator.subreseller.block');
        Route::post('sub-reseller-unblock','AdministratorDataController@sub_reseller_unblock')->name('adminstrator.subreseller.unblock');
        Route::post('sub-reseller-add-cradit','AdministratorDataController@sub_reseller_add_cradit')->name('adminstrator.subreseller.add.credit.bal');

        //vpn user
        Route::get('vpn-user','AdministratorDataController@vpn_user')->name('administrator.freeuser');
        Route::get('vpn-user-create','AdministratorDataController@vpn_user_craete')->name('adminstrator.create.free.user');
        Route::post('vpn-user-create','AdministratorDataController@vpn_user_store')->name('adminstrator.free.user.store');
        Route::get('vpn-user-edit/{id}','AdministratorDataController@vpn_user_edit')->name('adminstrator.free.user.edit');
        Route::post('vpn-user-edit','AdministratorDataController@vpn_user_update')->name('adminstrator.free.user.update');
        Route::post('vpn-user-delete','AdministratorDataController@vpn_user_delete')->name('administrator.free.user.delete');
        Route::post('vpn-user-block','AdministratorDataController@vpn_user_block')->name('administrator.free.user.block');
        Route::post('vpn-user-unblock','AdministratorDataController@vpn_user_unblock')->name('administrator.free.user.unblock');
        Route::post('vpn-user-cradit','AdministratorDataController@vpn_user_cradit')->name('administrator.freeuser.add.credit.bal');

        //quick user
        Route::get('quick-user','AdministratorDataController@quick_user')->name('administrator.create.quick.user');
        Route::post('quick-user','AdministratorDataController@quick_user_save')->name('administrator.quieck.user.save');

    });
});


Route::prefix('reseller')->group(function (){
    Route::get('/login','Auth\ResellerLoginController@showloginfrom')->name('reseller.login');
    Route::post('/login','Auth\ResellerLoginController@login')->name('reseller.login.submit');

    Route::get('/logout','Auth\ResellerLoginController@logout')->name('reseller.logout');
});

Route::group(['middleware'=>['auth:reseller']],function (){
    Route::prefix('reseller')->group(function (){

        Route::get('/','ResellerController@index')->name('reseller.dashboard');

        //sub reseller
        Route::get('/reseller-sub-reseller','ResellerDataController@reseller')->name('reseller.sub.reseller');
        Route::get('/reseller-sub-reseller-create','ResellerDataController@reseller_create')->name('reseller.create.subreseller');
        Route::post('/reseller-sub-reseller-create','ResellerDataController@reseller_save')->name('reseller.subreseller.create');
        Route::get('/reseller-sub-reseller-edit/{id}','ResellerDataController@reseller_edit')->name('reseller.sub.reseller.edit');
        Route::post('/reseller-sub-reseller-edit','ResellerDataController@reseller_update')->name('reseller.subreseller.update');
        Route::post('/reseller-sub-reseller-delete','ResellerDataController@reseller_delete')->name('reseller.subreseller.delete');
        Route::post('/reseller-sub-reseller-block','ResellerDataController@reseller_block')->name('reseller.subreseller.block');
        Route::post('/reseller-sub-reseller-unblock','ResellerDataController@reseller_unblock')->name('reseller.subreseller.unblock');
        Route::post('/reseller-sub-reseller-cradit','ResellerDataController@reseller_cradit')->name('reseller.subreseller.add.credit.bal');


        //free user
        Route::get('/reseller-free-user','ResellerDataController@free_user')->name('reseller.freeuser');
        Route::get('/reseller-free-create','ResellerDataController@free_user_create')->name('reseller.create.free.user');
        Route::post('/reseller-free-create','ResellerDataController@free_user_save')->name('reseller.free.user.store');
        Route::get('/reseller-free-edit/{id}','ResellerDataController@free_user_edit')->name('reseller.free.user.edit');
        Route::post('/reseller-free-edit','ResellerDataController@free_user_update')->name('reseller.free.user.update');
        Route::post('/reseller-free-delete','ResellerDataController@free_user_delete')->name('reseller.free.user.delete');
        Route::post('/reseller-free-block','ResellerDataController@free_user_block')->name('reseller.free.user.block');
        Route::post('/reseller-free-unblock','ResellerDataController@free_user_unblock')->name('reseller.free.user.unblock');
        Route::post('/reseller-free-cradit','ResellerDataController@free_user_cradit')->name('reseller.freeuser.add.credit.bal');
        Route::get('/reseller-quick-user','ResellerDataController@quick_user')->name('reseller.create.quick.user');
        Route::post('/reseller-quick-user','ResellerDataController@quick_user_save')->name('reseller.quieck.user.save');


    });
});


Route::prefix('subreseller')->group(function (){
    Route::get('/login','Auth\SubresellerLoginController@showloginfrom')->name('subreseller.login');
    Route::post('/login','Auth\SubresellerLoginController@login')->name('subreseller.login.submit');

    Route::get('/logout','Auth\SubresellerLoginController@logout')->name('subreseller.logout');
});

Route::group(['middleware'=>['auth:subreseller']],function (){
    Route::prefix('subreseller')->group(function (){

        Route::get('/','SuresellerController@index')->name('subreseller.dashboard');

        //free user
        Route::get('/subreseller-vpn-user','SuresellerController@vpn_user')->name('subreseller.freeuser');
        Route::get('/subreseller-vpn-user-create','SuresellerController@vpn_user_create')->name('subreseller.create.free.user');
        Route::post('/subreseller-vpn-user-create','SuresellerController@vpn_user_save')->name('subreseller.free.user.store');
        Route::get('/subreseller-vpn-user-edit/{id}','SuresellerController@vpn_user_edit')->name('subreseller.free.user.edit');
        Route::post('/subreseller-vpn-user-edit','SuresellerController@vpn_user_update')->name('subreseller.free.user.update');
        Route::post('/subreseller-vpn-user-delete','SuresellerController@vpn_user_delete')->name('subreseller.free.user.delete');
        Route::post('/subreseller-vpn-user-block','SuresellerController@vpn_user_block')->name('subreseller.free.user.block');
        Route::post('/subreseller-vpn-user-unblock','SuresellerController@vpn_user_unblock')->name('subreseller.free.user.unblock');
        Route::post('/subreseller-vpn-user-cradit','SuresellerController@vpn_user_cradit')->name('subreseller.freeuser.add.credit.bal');

        //quick user
        Route::get('/subreseller-quick-user','SuresellerController@quick_user')->name('subreseller.create.quick.user');
        Route::post('/subreseller-quick-user','SuresellerController@quick_user_save')->name('subreseller.quieck.user.save');

    });
});




