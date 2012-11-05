<?php

/*
 * This file is part of the Hedgehog framework.
 *
 * (c) Carl Alexander <carlalexander@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hedgehog\Extension\Memcached;

use Hedgehog\Component\DependencyInjection\ContainerBuilderInterface;
use Hedgehog\Component\DependencyInjection\Extension\ExtensionInterface;

class Extension implements ExtensionInterface
{
    public function register(ContainerBuilderInterface $builder)
    {
        if (!isset($builder['memcachedhost']) || !isset($builder['memcachedport'])) {
            return;
        }

        $builder['memcached'] = $builder->share(function () use ($builder) {
            return new Manager($builder['memcachedhost'], $builder['memcachedport'], $tapp['dbname']);
        });

        $builder['wordpressdb'] = $builder->share(function () use ($builder) {
            return new WordPressDB($builder['dbuser'], $builder['dbpassword'], $builder['dbname'], $builder['dbhost'], $builder['memcached']);
        });
    }
}