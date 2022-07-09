<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 17.02.2019
 */

use Illuminate\Http\Request;
use \KuzyT\Halfdream\Http\Controllers\Admin;

/*
|--------------------------------------------------------------------------
| Halfdream Routes
|--------------------------------------------------------------------------
|
| File with Halfdream routes.
|
*/

Route::group(['middleware' => ['web', 'locale']], function() {

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
        'as' => 'admin.'
    ], function() {
        Route::get('/', [Admin\AdminController::class, 'index'])->name('index');

        Route::group([
            'prefix' => '{module}',
            'as' => 'module.',
        ], function() {
            /**
             * I couldn't make an resource controller with parameter name with Laravel,
             * so here are custom equivalent controllers. With no 'show', but 'edit' instead.
             * And without 'patch' for 'update'.
             */
            Route::get('/', [Admin\ModuleController::class, 'index'])->name('index');
            Route::get('/create', [Admin\ModuleController::class, 'create'])->name('create');
            Route::post('/', [Admin\ModuleController::class, 'store'])->name('store');
            Route::get('/{id}', [Admin\ModuleController::class, 'edit'])->name('edit');
            Route::put('/{id}', [Admin\ModuleController::class, 'update'])->name('update');
            Route::delete('/{id}', [Admin\ModuleController::class, 'destroy'])->name('destroy');
        });

        /**
         * Uploading from admin panel.
         */
        Route::group(['prefix' => 'upload', 'as' => 'upload.',], function() {
            Route::post('/image', [Admin\UploadController::class, 'image'])->name('image');
            Route::post('/ckeditor', [Admin\UploadController::class, 'ckeditor'])->name('ckeditor');
        });

    });
});
