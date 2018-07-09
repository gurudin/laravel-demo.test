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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {
    // Get permission(route & permission)
    Route::get('/getPermission', 'AuthItemController@getPermission')->name('authItem.getPermission');

    // Set auth_item
    Route::post('/authItem', 'AuthItemController@setAuthItem')->name('authItem.setAuthItem');

    // Remove auth_item
    Route::delete('/authItem', 'AuthItemController@removeAuthItem')->name('authItem.removeAuthItem');

    /** Get menu (list or detail) */
    Route::get('/menu/{id?}', 'MenuController@getMenu')->name('menu.getMenu');

    /** Menu (create or update) */
    Route::match(['post', 'put'], '/menu', 'MenuController@save')->name('rms.menu.save');

    /** Delete menu */
    Route::delete('/menu', 'MenuController@delete')->name('rms.menu.delete');

});
