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

namespace SheerazGul\Tests\LaravelWonde;

use SheerazGul\LaravelWonde\WondeFactory;
use SheerazGul\LaravelWonde\WondeManager;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use Wonde\Client;

class ServiceProviderTest extends AbstractTestCase
{
    use ServiceProviderTrait;

    public function testWondeFactoryIsInjectable()
    {
        $this->assertIsInjectable(WondeFactory::class);
    }

    public function testWondeManagerIsInjectable()
    {
        $this->assertIsInjectable(WondeManager::class);
    }

    public function testBindings()
    {
        $this->assertIsInjectable(Client::class);

        $original = $this->app['wonde.connection'];
        $this->app['wonde']->reconnect();
        $new = $this->app['wonde.connection'];

        $this->assertNotSame($original, $new);
        $this->assertEquals($original, $new);
    }
}
