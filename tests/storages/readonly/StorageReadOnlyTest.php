<?php

use PHPUnit\Framework\TestCase;

use thread\storages\readonly\interfaces\StorageReadOnlyInterface;
use thread\storages\readonly\StorageReadOnly;

/**
 * Class StorageReadOnlyTest
 *
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StorageReadOnlyTest extends TestCase
{
    public function testCreate()
    {
        $obj = new StorageReadOnly([]);
        $this->assertInstanceOf(StorageReadOnlyInterface::class, $obj, 'it is not a StorageReadOnlyInterface');
    }

    /**
     * @dataProvider dataProvider
     */
    public function testInitData($data, $key, $expected)
    {
        $obj = new StorageReadOnly($data);
        $this->assertEquals($expected, $obj->get($key), 'it is no equal');
    }

    /**
     * @dataProvider dataProviderGet
     */
    public function testHas($data, $key)
    {
        $obj = new StorageReadOnly($data);
        $this->assertTrue($obj->has($key), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @dataProvider dataProviderGet
     */
    public function testAllData($data, $key)
    {
        $obj = new StorageReadOnly($data);
        $this->assertEquals(2, count($obj->getAllData()), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @dataProvider dataProviderGet
     */
    public function testGetKeys($data, $key)
    {
        $obj = new StorageReadOnly($data);
        $this->assertEquals(2, count($obj->getKeys()), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                ['0' => 'one', '1' => 'two'], '0', 'one'
            ],
            [
                ['0' => 'one', '1' => 'two'], '1', 'two'
            ],
        ];
    }

    /**
     * @return array
     */
    public function dataProviderGet()
    {
        return [
            [
                ['0' => 'one', '1' => 'two'], '0'
            ],
            [
                ['0' => 'one', '1' => 'two'], '1'
            ],
        ];
    }
}