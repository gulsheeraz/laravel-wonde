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

namespace SheerazGul\Tests\LaravelWonde\Facades;

use SheerazGul\LaravelWonde\Facades\Wonde;
use SheerazGul\LaravelWonde\WondeManager;
use SheerazGul\Tests\LaravelWonde\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class WondeTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'wonde';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Wonde::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return WondeManager::class;
    }
}
