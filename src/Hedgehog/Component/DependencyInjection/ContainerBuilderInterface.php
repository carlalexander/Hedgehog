<?php

/*
 * This file is part of the Hedgehog framework.
 *
 * (c) Carl Alexander <carlalexander@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hedgehog\Component\DependencyInjection;

use Hedgehog\Component\DependencyInjection\Extension\ExtensionInterface;

/**
 * Interface so a dependency injection container can register extensions.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
interface ContainerBuilderInterface extends ContainerInterface
{
    /**
     * Register an extension.
     *
     * @param ExtensionInterface $extension
     */
    public function register(ExtensionInterface $extension);
}