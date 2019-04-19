<?php

namespace JarJak\Tests;

use Doctrine\DBAL\Connection;
use JarJak\DBALManager;
use PHPUnit\Framework\TestCase;

/**
 * @package DBALManager
 * @author  Jarek Jakubowski <egger1991@gmail.com>
 */
class DBALManagerTest extends TestCase
{
    /**
     * @var Connection
     */
    protected $conn;

    protected function setUp()
    {
        $this->conn = $this->createMock(Connection::class);
    }

    public function testInsertOrUpdateByArray()
    {
        $dbal = $this->getDumbDbalManager();
        $res = $dbal->insertOrUpdateByArray('dumb_table', ['dumb' => 'value']);
        $this->assertEquals(0, $res);
    }

    public function testMultiInsertOrUpdateByArray()
    {
        $dbal = $this->getDumbDbalManager();
        $res = $dbal->multiInsertOrUpdateByArray('dumb_table', [['dumb' => 'value'], ['dumb' => 'value']]);
        $this->assertEquals(0, $res);
    }

    public function testMultiInsertOrUpdateByArrayReturnArray()
    {
        $dbal = $this->getDumbDbalManager();
        $res = $dbal->multiInsertOrUpdateByArray(
            'dumb_table',
            [['dumb' => 'value'], ['dumb' => 'value']],
            0,
            false,
            true
        );
        $this->assertEquals(['inserted' => 0, 'updated' => 0], $res);
    }

    public function testInsertIgnoreByArray()
    {
        $res = $this->getDumbDbalManager()->insertIgnoreByArray('dumb_table', ['dumb' => 'value'], []);
        $this->assertEquals(0, $res);
    }

    private function getDumbDbalManager()
    {
        $dbal = new DBALManager();
        $dbal->setConnection($this->conn);
        return $dbal;
    }
}
