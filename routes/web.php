<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 17.02.2019
 */

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Halfdream Routes
|--------------------------------------------------------------------------
|
| File with Halfdream routes.
|
*/

Route::group(['middleware' => ['web', 'locale'], 'namespace' => '\KuzyT\Halfdream\Http\Controllers'], function() {

    /**
     * Switch language.
     */
    if (\Halfdream::multiLocale()) {
        Route::get('/language/{locale}', function(Request $request) {
            $route = app('router')->getRoutes()->match($request->create(url()->previous()));

            return redirect()->route($route->getName(),
                array_merge($route->parameters(), ['locale' => \Halfdream::locale()])
            );
        })->name('language');
    }

    Route::group([
        'middleware' => ['auth', 'role:' . implode('|', config('halfdream.admin.roles.access'))],
        'prefix' => config('halfdream.admin.route'),
        'as' => 'admin.',
        'namespace' => 'Admin'
    ], function() {
        Route::get('/', 'AdminController@index')->name('index');

        Route::group([
            'prefix' => '{module}',
            'as' => 'module.',
        ], function() {
            /**
             * I couldn't make an resource controller with parameter name with Laravel,
             * so here are custom equivalent controllers. With no 'show', but 'edit' instead.
             * And without 'patch' for 'update'.
             */
            Route::get('/', 'ModuleController@index')->name('index');
            Route::get('/create', 'ModuleController@create')->name('create');
            Route::post('/', 'ModuleController@store')->name('store');
            Route::get('/{id}', 'ModuleController@edit')->name('edit');
            Route::put('/{id}', 'ModuleController@update')->name('update');
            Route::delete('/{id}', 'ModuleController@destroy')->name('destroy');
        });

        /**
         * Uploading from admin panel.
         */
        Route::group(['prefix' => 'upload', 'as' => 'upload.',], function() {
            Route::post('/image', 'UploadController@image')->name('image');
            Route::post('/ckeditor', 'UploadController@ckeditor')->name('ckeditor');
        });

    });
});
