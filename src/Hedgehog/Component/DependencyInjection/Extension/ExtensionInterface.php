<?php

/*
 * This file is part of the Hedgehog framework.
 *
 * (c) Carl Alexander <carlalexander@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hedgehog\Component\DependencyInjection\Extension;

use Hedgehog\Component\DependencyInjection\ContainerBuilderInterface;

/**
 * Interface for reusable container extensions.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
interface ExtensionInterface
{
    /**
     * Register this extension in the container
     *
     * @param ContainerBuilderInterface $builder
     */
    public function register(ContainerBuilderInterface $builder);
}