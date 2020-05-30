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

use Doctrine\DBAL\DBALException;

class DatabasePlatformMock extends \Doctrine\DBAL\Platforms\AbstractPlatform
{
    private $_sequenceNextValSql = '';
    private $_prefersIdentityColumns = true;
    private $_prefersSequences = false;

    /**
     * @override
     */
    public function prefersIdentityColumns()
    {
        return $this->_prefersIdentityColumns;
    }

    /**
     * @override
     */
    public function prefersSequences()
    {
        return $this->_prefersSequences;
    }

    /** @override */
    public function getSequenceNextValSQL($sequenceName)
    {
        return $this->_sequenceNextValSql;
    }

    /** @override */
    public function getBooleanTypeDeclarationSQL(array $field)
    {
    }

    /** @override */
    public function getIntegerTypeDeclarationSQL(array $field)
    {
    }

    /** @override */
    public function getBigIntTypeDeclarationSQL(array $field)
    {
    }

    /** @override */
    public function getSmallIntTypeDeclarationSQL(array $field)
    {
    }

    /** @override */
    protected function _getCommonIntegerTypeDeclarationSQL(array $columnDef)
    {
    }

    /** @override */
    public function getVarcharTypeDeclarationSQL(array $field)
    {
    }

    /** @override */
    public function getClobTypeDeclarationSQL(array $field)
    {
    }

    /* MOCK API */

    public function setPrefersIdentityColumns($bool)
    {
        $this->_prefersIdentityColumns = $bool;
    }

    public function setPrefersSequences($bool)
    {
        $this->_prefersSequences = $bool;
    }

    public function setSequenceNextValSql($sql)
    {
        $this->_sequenceNextValSql = $sql;
    }

    public function getName()
    {
        return 'mock';
    }

    protected function initializeDoctrineTypeMappings()
    {
    }

    protected function getVarcharTypeDeclarationSQLSnippet($length, $fixed)
    {
    }

    /**
     * Gets the SQL Snippet used to declare a BLOB column type.
     *
     * @throws DBALException
     */
    public function getBlobTypeDeclarationSQL(array $field)
    {
        throw DBALException::notSupported(__METHOD__);
    }
}
