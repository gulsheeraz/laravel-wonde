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
use GrahamCampbell\TestBench\AbstractTestCase as AbstractTestBenchTestCase;
use Wonde\Client;

class WondeFactoryTest extends AbstractTestBenchTestCase
{
    public function testMakeStandard()
    {
        $factory = $this->getWondeFactory();

        $return = $factory->make(['token' => 'your-token']);

        $this->assertInstanceOf(Client::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     *
     * @expectedExceptionMessage Wonde configuration token required.
     */
    public function testMakeWithoutToken()
    {
        $factory = $this->getWondeFactory();
        $factory->make(['app' => 'your-app']);
    }

    protected function getWondeFactory()
    {
        return new WondeFactory();
    }
}
