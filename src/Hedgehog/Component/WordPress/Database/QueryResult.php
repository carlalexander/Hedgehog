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
 * A WordPress query result.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class QueryResult
{
    /**
     * @var array
     */
    protected $result;
    /**
     * @var int
     */
    protected $foundRows = 0;
    /**
     * @var int
     */
    protected $affectedRows = 0;

    /**
     * Constructor
     *
     * @param array $result
     */
    public function __construct(array $result, $rowsAffected = 0)
    {
        $this->$result;
        $this->affectedRows = $rowsAffected;
    }

    /**
     * Set query result.
     *
     * @param array $result
     */
    public function setResult(array $result)
    {
        $this->result = $result;
    }

    /**
     * Get query result.
     *
     * @return array
     */
    public function getResult()
    {
       return $this->result;
    }

    /**
     * Set the number of rows found.
     *
     * @param int $foundRows
     */
    public function setFoundRows($foundRows)
    {
        $this->foundRows = $foundRows;
    }

    /**
     * Get the number of rows found.
     *
     * @return int
     */
    public function getFoundRows()
    {
        return $this->foundRows;
    }

    /**
     * Get affected rows.
     *
     * @return int
     */
    public function getAffectedRows()
    {
        return $this->affectedRows;
    }
}