<?php

namespace Brediweb\BrediDashboard\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class BrediColorAdminServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->publishAssets();
        $this->getConfig();
    }

    public function getConfig()
    {
        $this->app->booted(function () {
            try {
                if (Schema::hasTable('configs')) {
                    $config = (new \Brediweb\BrediDashboard\Repositories\BrediDashboardRepository)->getConfig();
                    view()->composer('*', function ($view) use ($config) {
                        return $view->with('config', $config);
                    });
                }
            } catch (\Exception $e) {
                // throw $e;
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('bredicoloradmin.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('bredicoloradmin.php'),
        ], 'dashboard-config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'bredicoloradmin'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/vendor/bredicoloradmin'); //destino views

        $sourcePath = __DIR__ . '/../Resources/views'; //origem views

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'dashboard-views');

        $this->publishes([
            $sourcePath . '/includes/menu.blade.php' => $viewPath . '/includes/menu.blade.php',
        ], 'dashboard-menu');

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/vendor/bredicoloradmin';
        }, \Config::get('view.paths')), [$sourcePath]), 'bredicoloradmin');
    }

    public function publishAssets()
    {
        $this->publishes([
            __DIR__ . '/../Public/webfonts' => public_path('coloradmin/webfonts'),
            __DIR__ . '/../Public/tinymce' => public_path('tinymce'),
            __DIR__ . '/../Public/images' => public_path('coloradmin/images'),
            __DIR__ . '/../Public/js' => public_path('coloradmin/js'),
            __DIR__ . '/../Public/css' => public_path('coloradmin/css'),
            __DIR__ . '/../Public/plugins' => public_path('plugins'),
        ], 'public-assets');

        $this->publishes([
            __DIR__ . '/../Public/tinymce' => public_path('tinymce'),
        ], 'editor-tinymce');

        $this->publishes([
            __DIR__ . '/../Public/summernote' => public_path('summernote'),
        ], 'editor-summernote');
    }
    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/vendor/bredicoloradmin');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'bredicoloradmin');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'bredicoloradmin');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        // if (! app()->environment('production')) {
        //     app(Factory::class)->load(__DIR__ . '/../Database/factories');
        // }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
