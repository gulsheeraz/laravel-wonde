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

use InvalidArgumentException;
use Wonde\Client;

/**
 * This is the main factory class for LaravelWonde.
 *
 * @author Sheeraz Gul <rahuja.sheeraz@gmail.com>
 */
class WondeFactory
{
    /**
     * Create a new Wonde Client.
     *
     * @param string[] $config
     *
     * @return \Wonde\Client
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string []
     *
     * @throws \InvalidArgumentException
     *
     * @return string[]
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('token', $config)) {
            throw new InvalidArgumentException('Wonde configuration token required.');
        }

        return array_only($config, ['token', 'school']);
    }

    /**
     * Get client.
     *
     * @param string[] $auth
     *
     * @return \Wonde\Client|\Wonde\Endpoints\Schools
     */
    protected function getClient(array $auth)
    {
        $client = new Client($auth['token']);

        if (array_key_exists('school', $auth) && !empty($auth['school'])) {
            return $client->school($auth['school']);
        }

        return $client;
    }
}
