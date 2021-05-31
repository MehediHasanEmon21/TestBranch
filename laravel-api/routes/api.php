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

Route::group(['namespace' => 'Api', 'prefix' => 'auth'], function () {
    //auth related api
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/user-info', 'AuthController@user_info')->middleware('auth:api');
    Route::post('/logout', 'AuthController@logout')->middleware('auth:api');
});

Route::group(['namespace' => 'Api'], function () {

    //role api
    Route::get('/role', 'RoleController@index');
    Route::post('/add-role', 'RoleController@store');
    Route::get('/edit-role/{id}', 'RoleController@edit');
    Route::post('/update-role/{id}', 'RoleController@update');
    Route::post('/delete-role/{id}', 'RoleController@destroy');
    //assign role api
    Route::get('/assign-role', 'AssignRoleController@all_assign_role');
    Route::post('/assign-role-add', 'AssignRoleController@add_assign_role');
    Route::post('/assign-role-update', 'AssignRoleController@update_assign_role');
    Route::post('/assign-role-delete', 'AssignRoleController@update_assign_delete');
    //all user api
    Route::get('/users', 'UserController@all_users');
});
