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

use Hedgehog\Component\Caching\Driver\DriverInterface;

/**
 * Manages all table versions.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class TableVersionManager
{
    /**
     * @var array
     */
    protected $tables = array();
    /**
     * @var DriverInterface
     */
    protected $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Gets the table versions for all tables involved in the query.
     *
     * @param Query $query
     * @return array
     */
    public function getTableVersionsForQuery(Query $query)
    {
        $versions = array();
        $tables = $query->getTables();
        $time = microtime();

        foreach ($tables as $table) {
            if (!isset($this->tables[$table])) {
                $this->tables[$table] = $this->driver->get($table);
            }

            if (!$this->tables[$table] instanceof TableVersion) {
                $this->tables[$table] = new TableVersion($table, $time);
                $this->driver->set($table, $this->tableVersions[$table]);
            }

            $versions[$table] = $this->tables[$table];
        }

        return $versions;
    }
}