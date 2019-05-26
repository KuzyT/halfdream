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


Route::group([
    'middleware' => 'locale'
], function() {

    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');

    \Halfdream::translatableRouteGroup([], function() {

        Route::get('/', '\KuzyT\Halfdream\Http\Controllers\Front\PostController@index')->name('index');

        Route::group([
            'prefix' => 'blog',
            'as' => 'post.',
        ], function() {
            Route::get('/', '\KuzyT\Halfdream\Http\Controllers\Front\PostController@index')->name('index');
            Route::get('{id}-{seo}', '\KuzyT\Halfdream\Http\Controllers\Front\PostController@show')->where(['id' => '[0-9]+', 'seo' => '[A-Za-z0-9-]+'])->name('show');
            Route::get('{id}', '\KuzyT\Halfdream\Http\Controllers\Front\PostController@show')->where('id', '[0-9]+')->name('shortshow');
        });

        Route::group([
            'prefix' => 'categories',
            'as' => 'category.',
        ], function() {
            Route::get('/', '\KuzyT\Halfdream\Http\Controllers\Front\CategoryController@index')->name('index');
            Route::get('{seo}', '\KuzyT\Halfdream\Http\Controllers\Front\CategoryController@show')->where(['id' => '[0-9]+', 'seo' => '[A-Za-z0-9-]+'])->name('show');
        });

        Route::group([
            'as' => 'page.',
        ], function() {
            Route::get('/{seo}', '\KuzyT\Halfdream\Http\Controllers\Front\PageController@show')->where('seo', '[A-Za-z0-9-]+')->name('show');
        });

    });
});

