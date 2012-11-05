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
 * A WordPress Database class that uses a caching service.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class CachingDatabase extends \wpdb
{
    /**
     * @var DriverInterface
     */
    protected $driver;

    /**
     * Constructor
     *
     * @param string $dbuser
     * @param string $dbpassword
     * @param string $dbname
     * @param string $dbhost
     * @param DriverInterface $driver
     */
    public function __construct($dbuser, $dbpassword, $dbname, $dbhost, DriverInterface $driver)
    {
        parent::__construct($dbuser, $dbpassword, $dbname, $dbhost);

        $this->driver = $driver;
    }

    /**
     * {@inheritdoc}
     */
    public function query($query)
    {
        $query = new Query($query, $this->base_prefix);

        if (strtoupper($query) == 'SELECT FOUND_ROWS()') {
            //$this->last_result = $this->lastQueryResult['total'];
        } else if ($query->isSelect()) {
            $this->doFetch($query);
        } else if ($query->isUpdate()
                   || $query->isInsert()
                   || $query->isDelete()
        ) {
            //$this->_doUpdate($query);
        } else {
            parent::query($query);
        }

        return true;
    }

    /**
     * Fetch the data from the cache or the database.
     *
     * @param Query $query
     */
    protected function doFetch(Query $query)
    {
        $result = $this->driver->get($query->getQuery());

        if (!$result instanceof CachedQueryResult) {
            $result = $this->queryDatabase($query);
            $this->driver->set($query->getQuery(), $result);
        }

        $this->last_result = $result->getResult();
    }

    /**
     * Perform database query.
     *
     * @param Query $query
     * @return CachedQueryResult
     */
    protected function queryDatabase(Query $query)
    {
        parent::query($query->getQuery());
        $result = new CachedQueryResult($this->last_result, $this->rows_affected);

        if ($query->usedFoundRows()) {
            parent::query('SELECT FOUND_ROWS()');
            $result->setFoundRows($this->last_result);
            $this->last_result = $result->getResult();
        }

        return $result;
    }
}