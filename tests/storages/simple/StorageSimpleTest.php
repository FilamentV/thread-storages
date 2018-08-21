<?php

use PHPUnit\Framework\TestCase;

use thread\storages\simple\interfaces\StorageSimpleInterface;
use thread\storages\simple\StorageSimple;

/**
 * Class StorageSimpleTest
 *
 * @author FilamentV <vortex.filament@gmail.com>
 * @copyright (c), Thread
 */
class StorageSimpleTest extends TestCase
{
    /**
     *
     */
    public function testCreate()
    {
        $obj = new StorageSimple();
        $this->assertInstanceOf(StorageSimpleInterface::class, $obj, 'it is not a StorageSimpleInterface');
    }

    /**
     *
     */
    public function testSet()
    {
        $obj = new StorageSimple();
        $this->assertTrue($obj->set('0', 'one'), __CLASS__ . '/' . __LINE__);
    }

    /**
     *
     */
    public function testDel()
    {
        $obj = new StorageSimple();
        $obj->set('0', 'one');
        $this->assertEquals('one', $obj->get('0'), __CLASS__ . '/' . __LINE__);
        $obj->delete('0');
        $this->assertFalse($obj->has('0'), __CLASS__ . '/' . __LINE__);
    }

    /**
     *
     */
    public function testGetAndHas()
    {
        $obj = new StorageSimple();
        $obj->set('0', 'one');
        $this->assertTrue($obj->has('0'), __CLASS__ . '/' . __LINE__);
        $this->assertEquals('one', $obj->get('0'), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @param $data
     * @param $key
     * @dataProvider dataProviderGet
     */
    public function testSetMultiple($data, $key)
    {
        $obj = new StorageSimple();
        $obj->setMultiple($data);
        $this->assertEquals($data, $obj->getAllData(), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @param $data
     * @param $key
     * @dataProvider dataProviderGet
     */
    public function testGetMultiple($data, $key)
    {
        $obj = new StorageSimple();
        $obj->setMultiple($data);
        $this->assertEquals($data, $obj->getMultiple(['0', '1']), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @dataProvider dataProviderGet
     */
    public function testAllData($data, $key)
    {
        $obj = new StorageSimple();
        $obj->setMultiple($data);
        $this->assertEquals(2, count($obj->getAllData()), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @dataProvider dataProviderGet
     */
    public function testGetKeys($data, $key)
    {
        $obj = new StorageSimple();
        $obj->setMultiple($data);
        $this->assertEquals(2, count($obj->getKeys()), __CLASS__ . '/' . __LINE__);
    }

    /**
     * @dataProvider dataProviderGet
     */
    public function testClear($data, $key)
    {
        $obj = new StorageSimple();
        $obj->setMultiple($data);
        $obj->clear();
        $this->assertEquals([], $obj->getAllData(), __CLASS__ . '/' . __LINE__);
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