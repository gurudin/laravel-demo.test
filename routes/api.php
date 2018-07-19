<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['namespace' => 'Api', 'middleware' => 'auth:api'], function () {

    //---------- Auth -----------//
    /** (Auth) Get auth menu by group_id */
    Route::get('/authMenu/{group_id?}', 'MenuController@authMenu')->name('menu.authMenu');

    /** (Auth) Get auth group by user_id */
    Route::get('/authGroup', 'AuthGroupController@authGroup')->name('authGroup.authGroup');

    /** (Auth) Get auth user by group_id */
    Route::get('/authUser/{group_id}', 'AuthUserController@getAuthUser')->name('authUser.getAuthUser');
    //---------- Auth end -----------//

    /** Get User */
    Route::get('/user', 'AuthGroupController@getUser')->name('authGroup.getUser');

    // Get permission(route & permission)
    Route::get('/getPermission', 'AuthItemController@getPermission')->name('authItem.getPermission');

    // Get role
    Route::get('/getRole', 'AuthItemController@getRole')->name('authItem.getRole');

    // Set auth_item
    Route::post('/authItem', 'AuthItemController@setAuthItem')->name('authItem.setAuthItem');

    // Update auth_item
    Route::put('/authItem', 'AuthItemController@updateAuthItem')->name('authItem.updateAuthItem');

    // Remove auth_item
    Route::delete('/authItem', 'AuthItemController@removeAuthItem')->name('authItem.removeAuthItem');

    /** Get auth_item_child by parent */
    Route::get('/authItemChild/{name?}', 'AuthItemChildController@authItemChild')->name('authItemChild.authItemChild');

    /** Set auth_item_child */
    Route::post('/authItemChild', 'AuthItemChildController@setAuthItemChild')->name('authItemChild.setAuthItemChild');

    /** Set auth_item_child */
    Route::delete('/authItemChild', 'AuthItemChildController@removeAuthItemChild')->name('authItemChild.removeAuthItemChild');

    /** Get menu (list or detail) */
    Route::get('/menu/{id?}', 'MenuController@getMenu')->name('menu.getMenu');

    /** Menu (create or update) */
    Route::match(['post', 'put'], '/menu', 'MenuController@save')->name('menu.save');

    /** Delete menu */
    Route::delete('/menu', 'MenuController@delete')->name('menu.delete');

    /** Get group */
    Route::get('/group/{id?}', 'AuthGroupController@getGroup')->name('authGroup.getGroup');

    /** Set group (create or update) */
    Route::match(['post', 'put'], '/group', 'AuthGroupController@setGroup')->name('authGroup.setGroup');

    /** Remove group by id */
    Route::delete('/group', 'AuthGroupController@removeGroup')->name('authGroup.removeGroup');

    /** Get group user child */
    Route::get('/groupUserChild/{id}', 'AuthGroupController@getGroupUserChild')->name('authGroup.getGroupUserChild');

    /** Get group item child */
    Route::get('/groupItemChild/{id}', 'AuthGroupController@getGroupItemChild')->name('authGroup.getGroupItemChild');

    /** Set group child */
    Route::post('/groupChild', 'AuthGroupController@setAuthGroupChild')->name('authGroup.setAuthGroupChild');

    /** Remove group child */
    Route::delete('/groupChild', 'AuthGroupController@removeAuthGroup')->name('authGroup.removeAuthGroup');
});

Route::group(['namespace' => 'Api'], function () {
    /** User register */
    Route::post('/register', 'AuthUserController@register')->name('authUser.register');

    /** User login */
    Route::post('/login', 'AuthUserController@login')->name('authUser.login');
});
