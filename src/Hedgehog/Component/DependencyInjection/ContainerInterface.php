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

/**
 * Interface for the dependency injection classes.
 */
interface ContainerInterface extends \ArrayAccess
{
    /**
     * Returns a closure that stores the result of the given closure for
     * uniqueness in the scope of this instance of Pimple.
     *
     * @param Closure $callable A closure to wrap for uniqueness
     *
     * @return Closure The wrapped closure
     */
    public function share(\Closure $callable);

    /**
     * Protects a callable from being interpreted as a service.
     *
     * This is useful when you want to store a callable as a parameter.
     *
     * @param Closure $callable A closure to protect from being evaluated
     *
     * @return Closure The protected closure
     */
    public function protect(\Closure $callable);

    /**
     * Gets a parameter or the closure defining an object.
     *
     * @param  string $id The unique identifier for the parameter or object
     *
     * @return mixed  The value of the parameter or the closure defining an object
     *
     * @throws InvalidArgumentException if the identifier is not defined
     */
    function raw($id);

    /**
     * Extends an object definition.
     *
     * Useful when you want to extend an existing object definition,
     * without necessarily loading that object.
     *
     * @param  string  $id       The unique identifier for the object
     * @param  Closure $callable A closure to extend the original
     *
     * @return Closure The wrapped closure
     *
     * @throws InvalidArgumentException if the identifier is not defined
     */
    function extend($id, \Closure $callable);
}