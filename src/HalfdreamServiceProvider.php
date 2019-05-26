<?php
/**
 * Created by PhpStorm.
 * User: KuzyT
 * Date: 19.12.2018
 */

namespace KuzyT\Halfdream;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Contracts\Events\Dispatcher;
use KuzyT\Halfdream\Admin\Navigation\NavigationLink;
use KuzyT\Halfdream\Facades\Halfdream as HalfdreamFacade;
use Illuminate\Foundation\AliasLoader;
use KuzyT\Halfdream\Modules\CategoryModule;
use KuzyT\Halfdream\Modules\IconModule;
use KuzyT\Halfdream\Modules\MenuItemModule;
use KuzyT\Halfdream\Modules\MenuModule;
use KuzyT\Halfdream\Modules\PageModule;
use KuzyT\Halfdream\Modules\PostModule;

class HalfdreamServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router, Dispatcher $event)
    {
        $this->mergeConfigFrom(__DIR__.'/../publishable/config/halfdream.php', 'halfdream');

        $this->publishes([
            // Config
            __DIR__.'/../publishable/config/halfdream.php' => config_path('halfdream.php'),

            // Views, js, sass
            __DIR__.'/../publishable/resources' => resource_path(),

            // Public
            __DIR__.'/../publishable/public' => public_path(),

            // Database
            __DIR__.'/../publishable/database' => base_path('database'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'halfdream');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'halfdream');

        $router->aliasMiddleware('role', \Spatie\Permission\Middlewares\RoleMiddleware::class);
        $router->aliasMiddleware('permission', \Spatie\Permission\Middlewares\PermissionMiddleware::class);
        $router->aliasMiddleware('role_or_permission', \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class);
        $router->aliasMiddleware('locale', \KuzyT\Halfdream\Http\Middleware\Locale::class);

        $this->commands([
            Commands\AdminCommand::class,
            Commands\InstallCommand::class,
            Commands\IconsCommand::class
        ]);

        // todo - maybe move in another Provider

        \Halfdream::addModule([
            PostModule::class,
            PageModule::class,
            CategoryModule::class,
            MenuModule::class,
            MenuItemModule::class,
            IconModule::class
        ]);


        // todo - move too. There is default Navigation creation

        \Halfdream::adminNavigation([
            NavigationLink::label('halfdream::admin.main_menu', true),
            NavigationLink::link('halfdream::admin.home', config('halfdream.admin.route'), 'home', true),
            NavigationLink::adminModule(PostModule::class),
            NavigationLink::adminModule(PageModule::class),
            NavigationLink::adminModule(CategoryModule::class),
            NavigationLink::adminModule(MenuModule::class),
            NavigationLink::adminModule(IconModule::class)
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Halfdream', HalfdreamFacade::class);

        $this->app->singleton('halfdream', function () {
            return new Halfdream();
        });

        // Load helper
        foreach (glob(__DIR__.'/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
