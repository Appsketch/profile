<?php

namespace Appsketch\Profile\Providers;

use Appsketch\Profile\Profile;
use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider
{
    /**
     * Indicates of loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config
        $this->publishConfig();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Profile.
        $this->registerProfile();

        // Merge config.
        $this->mergeConfig();
    }

    /**
     * Register Profile.
     */
    private function registerProfile()
    {
        $this->app->bind('Appsketch\Profile\Profile', function()
        {
            return new Profile();
        });
    }

    /**
     * Publish config.
     */
    private function publishConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/profile.php' => config_path('profile.php')
        ]);
    }

    /**
     * Merge config.
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/profile.php', 'profile'
        );
    }
}
