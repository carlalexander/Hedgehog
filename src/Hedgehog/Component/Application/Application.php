<?php

/*
 * This file is part of the Hedgehog framework.
 *
 * (c) Carl Alexander <carlalexander@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hedgehog\Component\Application;

use Hedgehog\Component\DependencyInjection\Container;
use Hedgehog\Component\DependencyInjection\ContainerBuilderInterface;
use Hedgehog\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * Application class that powers the framework.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class Application extends Container implements ContainerBuilderInterface
{
    /**
     * @var array
     */
    protected $extensions = array();
    /**
     * @var Boolean
     */
    protected $booted = false;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this['debug'] = false;
        $this['charset'] = 'UTF-8';
        $this['request.http_port'] = 80;
        $this['request.https_port'] = 443;

        $this['dbhost'] = defined('DB_HOST') ? DB_HOST : '';
        $this['dbname'] = defined('DB_NAME') ? DB_NAME : '';
        $this['dbuser'] = defined('DB_USER') ? DB_USER : '';
        $this['dbpassword'] = defined('DB_PASSWORD') ? DB_PASSWORD : '';
    }

    /**
     * {@inheritdoc}
     */
    public function register(ExtensionInterface $extension)
    {
        $this->extensions[] = $extension;

        $extension->register($this);
    }
}