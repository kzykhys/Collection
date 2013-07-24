<?php

use KzykHys\PHPCollection\MutableCollection\MutableCollection;

class MutableCollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testEach()
    {
        $obj = new MutableCollection(array(1, 2, 3, 4));

        $result = $obj->each(function ($number) { return $number * 2; });

        $this->assertSame($obj, $result);
        $this->assertEquals(array(2, 4, 6, 8), $result->toArray());
    }

    public function testFilter()
    {
        $obj = new MutableCollection(array(1, 2, 3, 4));

        $result = $obj->filter(function ($number) { return $number % 2 == 0; });

        $this->assertSame($obj, $result);
        $this->assertEquals(array(2, 4), $result->values());
    }

    public function testMerge()
    {
        $obj = new MutableCollection(array('foo' => 'bar', 'bar' => 'baz', 5));
        $result = $obj->merge(new MutableCollection(array('bar' => 'BAZ', 10)));

        $this->assertSame($obj, $result);
        $this->assertEquals(array('foo' => 'bar', 'bar' => 'BAZ', 5, 10), $result->toArray());
    }

    public function testUnique()
    {
        $obj = new MutableCollection(array('foo' => 100, 100, 50, '50'));
        $result = $obj->unique();

        $this->assertSame($obj, $result);
        $this->assertEquals(array('foo' => 100, 1 => 50), $result->toArray());
    }

    public function testArrayAccessWithInvalidKey()
    {
        $obj = new MutableCollection();
        $obj['foo']['bar'] = 1;

        $this->assertInstanceOf('KzykHys\\PHPCollection\\MutableCollection\\MutableCollection', $obj->get('foo'));
    }

}