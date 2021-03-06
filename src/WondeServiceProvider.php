<?php

/*
 * This file is part of Laravel Wonde.
 *
 * (c) Sheeraz Gul <rahuja.sheeraz@gmail.com>
 *
 * Based on the Laravel Manager package by Graham Campbell.
 *
 * For the full copyright and license information, please view the
 * LICENSE file which was distributed with this source code.
 */

namespace SheerazGul\LaravelWonde;

use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Wonde\Client as WondeClient;

/**
 * This is the main Wonde service provider class.
 *
 * @author Sheeraz Gul <rahuja.sheeraz@gmail.com>
 */
class WondeServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/wonde.php');

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('wonde.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('wonde');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFactory();
        $this->registerManager();
        $this->registerBindings();
    }

    /**
     * Register the Wonde factory class.
     *
     * @return void
     */
    protected function registerFactory()
    {
        $this->app->singleton('wonde.factory', function (Container $app) {
            return new WondeFactory();
        });

        $this->app->alias('wonde.factory', WondeFactory::class);
    }

    /**
     * Register the manager class.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('wonde', function (Container $app) {
            $config = $app['config'];
            $factory = $app['wonde.factory'];

            return new WondeManager($config, $factory);
        });

        $this->app->alias('wonde', WondeManager::class);
    }

    /**
     * Register bindings.
     *
     * @return void
     */
    protected function registerBindings()
    {
        $this->app->bind('wonde.connection', function (Container $app) {
            $manager = $app['wonde'];

            return $manager->connection();
        });

        $this->app->alias('wonde.connection', WondeClient::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'wonde.factory',
            'wonde',
            'wonde.connection',
        ];
    }
}
