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
 * A cached WordPress query result.
 *
 * @author Carl Alexander <carlalexander@gmail.com>
 */
class CachedQueryResult extends QueryResult
{
    /**
     * @var array
     */
    protected $tableVersions;

    public function __construct(array $result)
    {
        parent::__construct($result);
    }
}