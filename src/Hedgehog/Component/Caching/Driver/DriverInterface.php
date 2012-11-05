<?php

/*
 * This file is part of the Hedgehog framework.
 *
 * (c) Carl Alexander <carlalexander@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hedgehog\Component\Caching\Driver;

/**
 * Driver interface for caching services.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
interface DriverInterface
{
    /**
     * Set data into the caching server.
     *
     * @param string $key
     * @param mixed $value
     * @param int $expire
     * @return boolean
     */
    public function set($key, $value, $expire = 0);

    /**
     * Get data from the caching server.
     *
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * Delete data in the memcached server
     *
     * @param string $key
     * @return boolean
     */
    public function delete($key);

    /**
     * Clear data in the caching server.
     *
     * @return boolean
     */
    public function flush();
}