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

Route::name('api.admin.')->group(function (){
    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'admin',
        'namespace' => 'Admin\Api'
    ], function () {
        Route::apiResource('/posts', 'PostController');
        Route::get('/categories/{category}/subs', 'CategoryController@subs');
        Route::get('/categories/{category}/fields', 'CategoryController@fields');
        Route::post('/categories/{category}/addSub', 'CategoryController@addSub');
        Route::post('/categories/{category}/fields/create', 'CategoryController@addField');
        Route::post('/categories/{category}/fields/detach', 'CategoryController@detach');
        Route::apiResource('/categories', 'CategoryController');
        Route::get('/fields/type', 'FieldController@type');
        Route::post('/fields/{field}/categories/attach', 'FieldController@attach');
        Route::post('/fields/{field}/categories/detach', 'FieldController@detach');
        Route::apiResource('/fields', 'FieldController');
        Route::apiResource('/fields/{field_id}/options', 'OptionController');
    });
});
