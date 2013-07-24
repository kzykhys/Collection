<?php


use KzykHys\PHPCollection\Collection\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testInheritInterface()
    {
        $obj = new Collection();

        $this->assertInstanceOf('KzykHys\\PHPCollection\\Collection\\CollectionInterface', $obj);
        $this->assertInstanceOf('KzykHys\\PHPCollection\\ArrayAccess\\ArrayObjectInterface', $obj);
        $this->assertInstanceOf('Traversable', $obj);
        $this->assertInstanceOf('Countable', $obj);
    }

    public function testManipulation()
    {
        $obj = new Collection(array());

        $obj->add(1);
        $obj->set('foo', 2);
        $obj->add(3);

        $this->assertEquals(2, $obj->get('foo'));
        $this->assertNull($obj->get('bar'));
        $this->assertEquals(100, $obj->get('bar', 100));

        $obj->remove('foo')->removeElement(3);

        $this->assertFalse($obj->exists('foo'));
        $this->assertFalse($obj->contains(3));

        $obj->add(2)->add(3);

        $this->assertEquals(1, $obj->first());
        $this->assertEquals(3, $obj->last());
    }

    public function testEach()
    {
        $obj = new Collection(array(1, 2, 3, 4));

        $result = $obj->each(function ($number) { return $number * 2; });

        $this->assertNotSame($obj, $result);
        $this->assertEquals(array(2, 4, 6, 8), $result->toArray());
    }

    public function testFilter()
    {
        $obj = new Collection(array(1, 2, 3, 4));

        $result = $obj->filter(function ($number) { return $number % 2 == 0; });

        $this->assertNotSame($obj, $result);
        $this->assertEquals(array(2, 4), $result->values());
    }

    public function testDiff()
    {
        $obj = new Collection(array(1, 2, 3, 4));

        $result = $obj->diff(new Collection(array(3, 4)));

        $this->assertNotSame($obj, $result);
        $this->assertEquals(array(1, 2), $result->values());
    }

    public function testMerge()
    {
        $obj = new Collection(array('foo' => 'bar', 'bar' => 'baz', 5));
        $result = $obj->merge(new Collection(array('bar' => 'BAZ', 10)));

        $this->assertNotSame($obj, $result);
        $this->assertEquals(array('foo' => 'bar', 'bar' => 'BAZ', 5, 10), $result->toArray());
    }

    public function testUnique()
    {
        $obj = new Collection(array('foo' => 100, 100, 50, '50'));
        $result = $obj->unique();

        $this->assertNotSame($obj, $result);
        $this->assertEquals(array('foo' => 100, 1 => 50), $result->toArray());
    }

    public function testJoin()
    {
        $obj = new Collection(array('a', 'b', 'c'));

        $this->assertEquals('abc', $obj->join());
        $this->assertEquals('a b c', $obj->join(' '));
    }

    public function testKeysAndValues()
    {
        $obj = new Collection(array('a' => 1, 2));
        $this->assertEquals(array('a', 0), $obj->keys());
        $this->assertEquals(array(1, 2), $obj->values());
    }

    public function testCountable()
    {
        $obj = new Collection(array('a', 'b', 'c'));
        $this->assertCount(3, $obj);
    }

    public function testTraversable()
    {
        $obj = new Collection(array('a', 'b', 'c'));
        $this->assertEquals(array('a', 'b', 'c'), iterator_to_array($obj));
    }

}