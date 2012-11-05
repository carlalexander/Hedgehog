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
 * Generic driver class.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
abstract class Driver implements DriverInterface
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * {@inheritdoc}
     */
    public function set($key, $value, $expire = 0)
    {
        return $this->doSet($this->generateKey($key), $value, false, $expire);
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        return $this->doGet($this->generateKey($key));
    }

    /**
     * {@inheritdoc}
     */
    public function delete($key)
    {
        $this->doDelete($this->generateKey($key));
    }

    /**
     * Generates a unique key so that there's no conflicts.
     *
     * @param string $key
     * @return string
     */
    protected function generateKey($key)
    {
        return md5($this->prefix . $key);
    }

    /**
     * Set data into the caching server.
     *
     * @param string $key
     * @param mixed $value
     * @param int $expire
     * @return boolean
     */
    abstract protected function doSet($key, $value, $expire = 0);

    /**
     * Get data from the caching server.
     *
     * @param string $key
     * @return mixed
     */
    abstract protected function doGet($key);

    /**
     * Delete data in the memcached server
     *
     * @param string $key
     * @return boolean
     */
    abstract protected function doDelete($key);
}