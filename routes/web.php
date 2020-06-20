<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::name('admin.')->group(function (){
    Route::group([
        'middleware' => ['role:admin'],
        'prefix' => 'admin',
        'namespace' => 'Admin'
    ], function () {
        Route::get('/', 'DefaultController@index')->name('admin.index');
        Route::get('/categories', 'CategoryController@index')->name('categories.index');
        Route::get('/categories/{any}', 'CategoryController@index')->where('any', '.*');
    });
});
