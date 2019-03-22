<?php
namespace CodersStudio\Notifications;
use Illuminate\Support\ServiceProvider;

class NotificationsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {  
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'codersstudio');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'codersstudio');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');
         
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->mergeConfigFrom(__DIR__.'/../config/notifications.php', 'notifications');

        // Register the service the package provides.
        $this->app->singleton('notifications', function ($app) {
            return new Notifications;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['notifications'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/notifications.php' => config_path('notifications.php'),
        ], 'notifications.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/codersstudio'),
        ], 'notifications.views');*/

        // Publishing assets.
        $this->publishes([
            __DIR__.'/../resources/assets' =>  base_path('resources/assets/vendor/codersstudio'),
        ], 'notifications.assets');

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/codersstudio'),
        ], 'notifications.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
