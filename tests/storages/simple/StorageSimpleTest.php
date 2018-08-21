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
    public function testGetAndHas()
    {
        $obj = new StorageSimple();
        $obj->set('0', 'one');
        $this->assertTrue($obj->has('0'), __CLASS__ . '/' . __LINE__);
        $this->assertEquals('one', $obj->get('0'), __CLASS__ . '/' . __LINE__);
    }
}