<?php

declare(strict_types=1);

/*
 * This file is part of the RollerworksSearch package.
 *
 * (c) Sebastiaan Stok <s.stok@rollerscapes.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Rollerworks\Component\Search\Tests\Doctrine\Dbal\Mocks;

class ConnectionMock extends \Doctrine\DBAL\Connection
{
    private $_fetchOneResult;
    private $_platform;
    private $_platformMock;
    private $_lastInsertId = 0;
    private $_inserts = [];

    public function __construct(array $params, $driver, $config = null, $eventManager = null)
    {
        $this->_platformMock = new DatabasePlatformMock();

        parent::__construct($params, $driver, $config, $eventManager);

        // Override possible assignment of platform to database platform mock
        $this->_platform = $this->_platformMock;
    }

    /**
     * @override
     */
    public function getDatabasePlatform()
    {
        return $this->_platformMock;
    }

    /**
     * @override
     */
    public function insert($tableName, array $data, array $types = [])
    {
        $this->_inserts[$tableName][] = $data;
    }

    /**
     * @override
     */
    public function lastInsertId($seqName = null)
    {
        return $this->_lastInsertId;
    }

    /**
     * @override
     */
    public function fetchColumn($statement, array $params = [], $column = 0, array $types = [])
    {
        return $this->_fetchOneResult;
    }

    /**
     * @override
     */
    public function quote($input, $type = null)
    {
        if (\is_string($input)) {
            return "'".$input."'";
        }

        return $input;
    }

    /* Mock API */

    public function setFetchOneResult($fetchOneResult)
    {
        $this->_fetchOneResult = $fetchOneResult;
    }

    public function setDatabasePlatform($platform)
    {
        $this->_platformMock = $platform;
    }

    public function setLastInsertId($id)
    {
        $this->_lastInsertId = $id;
    }

    public function getInserts()
    {
        return $this->_inserts;
    }

    public function reset()
    {
        $this->_inserts = [];
        $this->_lastInsertId = 0;
    }
}
