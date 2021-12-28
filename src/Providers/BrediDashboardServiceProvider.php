<?php

namespace Brediweb\BrediDashboard8\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Brediweb\BrediDashboard8\Console\InstallCommand;

class BrediDashboardServiceProvider extends ServiceProvider
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
        // $this->registerPolicies();

        $file = __DIR__ . '/../Http/Helper/Helper.php';

        if (file_exists($file)) {
            require_once $file;
        }

        $this->loadViewsFrom(__DIR__.'/views', 'bredicoloradmin');
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->configureCommands();

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
            __DIR__ . '/../Config/config.php' => config_path('BrediDashboard.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('BrediDashboard.php'),
        ], 'BrediDashboard-config');
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'BrediDashboard'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/BrediDashboard');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/BrediDashboard';
        }, \Config::get('view.paths')), [$sourcePath]), 'BrediDashboard');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/BrediDashboard');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'BrediDashboard');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'BrediDashboard');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        // if (!app()->environment('production')) {
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

    /**
     * Configure the commands offered by the application.
     *
     * @return void
     */
    protected function configureCommands()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCommand::class,
        ]);
    }
}
