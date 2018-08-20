<?php

use PHPUnit\Framework\TestCase;

use thread\storages\StoragesReadOnlyService;
use thread\storages\readonly\StorageReadOnly;

/**
 *
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StoragesReadOnlyServiceTest extends TestCase
{
    /**
     *
     */
    public function testCreate()
    {
        $obj = new StoragesReadOnlyService();
        $this->assertInstanceOf(StoragesReadOnlyService::class, $obj, 'it is not a StoragesReadOnlyService');
    }

    /**
     *
     */
    public function testAddStorage()
    {
        $obj = new StoragesReadOnlyService();
        $obj->addStorage('test', new StorageReadOnly([
            '0' => 'one',
            '1' => 'two',
        ]));
        $this->assertTrue($obj->hasStorage('test'), __CLASS__ . '/' . __LINE__);
    }

    /**
     *
     */
    public function testSetCurrencyStorage()
    {
        $obj = new StoragesReadOnlyService();
        $obj->addStorage('test', new StorageReadOnly([
            '0' => 'one',
            '1' => 'two',
        ]));
        $this->assertTrue($obj->setCurrency('test'), __CLASS__ . '/' . __LINE__);
        $this->assertFalse($obj->setCurrency('test2'), __CLASS__ . '/' . __LINE__);
    }

    /**
     *
     */
    public function testGetStorageData()
    {
        $obj = new StoragesReadOnlyService();
        $obj->addStorage('test', new StorageReadOnly([
            '0' => 'one'
        ]));
        $this->assertEquals('one', $obj->getStorageData('test', '0'), __CLASS__ . '/' . __LINE__);
    }
}
