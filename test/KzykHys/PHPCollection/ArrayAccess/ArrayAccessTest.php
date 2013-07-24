<?php

use KzykHys\PHPCollection\ArrayAccess\ArrayAccess;

class ArrayAccessTest extends \PHPUnit_Framework_TestCase
{

    public function testArrayAccessInterface()
    {
        $obj = new ArrayAccess();

        $this->assertInstanceOf('ArrayAccess', $obj);

        $obj['foo'] = 'bar';
        $obj[] = 'baz';
        $obj['removed'] = true;
        unset($obj['removed']);

        $this->assertEquals('bar', $obj['foo']);
        $this->assertFalse(isset($obj['removed']));
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testArrayOffsetGetThrowsException()
    {
        $obj = new ArrayAccess();
        $obj['foo'];
    }

    public function testArrayObjectInterface()
    {
        /* @var ArrayAccess $obj */
        $obj = new ArrayAccess();

        $this->assertInstanceOf('KzykHys\\PHPCollection\\ArrayAccess\\ArrayObjectInterface', $obj);

        $obj['foo'] = 'bar';
        $obj[] = 'baz';

        $this->assertEquals(array('foo' => 'bar', 'baz'), $obj->toArray());
    }

}