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
 * Represents a WordPress MySQL query.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class Query
{
    const TYPE_SELECT = 1;
    const TYPE_UPDATE = 2;
    const TYPE_INSERT = 3;
    const TYPE_DELETE = 4;

    /**
     * @var string
     */
    protected $query;
    /**
     * @var string
     */
    protected $prefix;
    /**
     * @var int
     */
    protected $type;

    /**
     * Constructor
     *
     * @param string $query
     * @param string $prefix
     */
    public function __construct($query, $prefix = 'wp_')
    {
        if (!is_string($query)) {
            throw new \InvalidArgumentException('Query must be a string');
        }

        $this->query = $query;
        $this->prefix = $prefix;
    }

    /**
     * Get the query string.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Get all the tables involved with query.
     *
     * @return array
     */
    public function getTables()
    {
        $tables = array();
        preg_match_all("/($this->prefix[\w]*)[`\s]?/i", $this->query, $tables);

        return $tables[1];
    }

    /**
     * Checks if the query is a select query.
     *
     * @return boolean
     */
    public function isSelect()
    {
        return $this->type === self::TYPE_SELECT;
    }

    /**
     * Checks if the query is an update query.
     *
     * @return boolean
     */
    public function isUpdate()
    {
        return $this->type === self::TYPE_UPDATE;
    }

    /**
     * Checks if the query is an insert query.
     *
     * @return boolean
     */
    public function isInsert()
    {
        return $this->type === self::TYPE_INSERT;
    }

    /**
     * Checks if the query is a delete query.
     *
     * @return boolean
     */
    public function isDelete()
    {
        return $this->type === self::TYPE_DELETE;
    }

    /**
     * Checks if the query used 'SQL_CALC_FOUND_ROWS'
     *
     * @return boolean
     */
    public function usedFoundRows()
    {
        return $this->isType('SQL_CALC_FOUND_ROWS');
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->query;
    }

    /**
     * Get the query type. Returns null if it cannot be determined.
     *
     * @return mixed
     */
    protected function getType()
    {
        if ($this->isType('SELECT')) {
            return self::TYPE_SELECT;
        } else if ($this->isType('UPDATE')) {
            return self::TYPE_UPDATE;
        } else if ($this->isType('INSERT')) {
            return self::TYPE_INSERT;
        } else if ($this->isType('DELETE')) {
            return self::TYPE_DELETE;
        }

        return null;
    }

    /**
     * Check the type of query.
     *
     * @param string $type
     * @return boolean
     */
    protected function isType($type)
    {
        return stripos($this->query, $type) !== false;
    }
}