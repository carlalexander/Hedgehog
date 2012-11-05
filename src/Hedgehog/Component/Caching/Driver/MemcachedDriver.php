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

use \Memcached;

/**
 * Memcached driver.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class MemcachedDriver extends Driver
{
    /**
     * @var Memcached
     */
    protected $memcached;

    /**
     * Constructor
     *
     * @param string $host
     * @param string $port
     * @param string $prefix
     */
    public function __construct($host, $port, $prefix = '')
    {
        $this->memcached = new Memcached();
        $this->memcached->addServer($host, $port);
        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        return $this->memcached->flush();
    }

    /**
     * {@inheritdoc}
     */
    protected function doSet($key, $value, $expire = 0)
    {
        return $this->memcached->set($this->generateKey($key), $value, false, $expire);
    }

    /**
     * {@inheritdoc}
     */
    protected function doGet($key)
    {
        return $this->memcached->get($key);
    }

    /**
     * {@inheritdoc}
     */
    protected function doDelete($key)
    {
        $this->memcached->delete($key);
    }
}