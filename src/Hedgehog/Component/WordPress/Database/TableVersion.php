<?php

/*
 * This file is part of the Hedgehog framework.
 *
 * (c) Carl Alexander <carlalexander@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hedgehog\Component\WordPress\Database;

/**
 * Represents a table and its version.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class TableVersion
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $version;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $version
     */
    public function __construct($name, $version)
    {
        $this->name = $name;
        $this->version = $version;
    }

    /**
     * Get table name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set table version
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }
}
