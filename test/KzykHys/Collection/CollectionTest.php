<?php

use KzykHys\Collection\Collection;

/**
 * CollectionTest.php
 * 
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */ 
class CollectionTest extends \PHPUnit_Framework_TestCase
{

    public function testAppendAndRetrieve()
    {
        $object = new Collection();
        $object->add(1);
        $object->set('test', 2);
        $object->add(3);
        $object->set('test2', 4);

        $this->assertEquals(array(1, 'test' => 2, 3, 'test2' => 4), $object->toArray());
        $this->assertEquals(2, $object->get('test'));
        $this->assertEquals(1, $object->first());
        $this->assertEquals(4, $object->last());
    }

    public function testCountable()
    {
        $object = new Collection();
        $object->add(1);
        $object->add(2);

        $this->assertEquals(2, count($object));
    }

    public function testArrayAccess()
    {
        $object = new Collection();
        $object['test'] = 1;
        $object[] = 2;

        $this->assertEquals(1, $object['test']);
        $this->assertTrue(isset($object['test']));
        $this->assertFalse(isset($object['foo']));

        unset($object['test']);
        $this->assertFalse(isset($object['test']));
    }

    public function testFilter()
    {
        $object = new Collection(array(1, 2, 3, 4));
        $object = $object->filter(function ($var) {
            return ($var & 1);
        });

        $this->assertEquals(array(1, 3), array_values($object->toArray()));
    }

    public function testMap()
    {
        $object = new Collection(array(1, 2, 3, 4));
        $object = $object->map(function ($var) {
            return $var * 2;
        });

        $this->assertEquals(array(2, 4, 6, 8), $object->toArray());
    }

    public function testDiff()
    {
        $objectA = new Collection(array(1, 2, 3, 4));
        $objectB = new Collection(array(1, 10, 3, 4));

        $diff = $objectA->diff($objectB);
        $this->assertEquals(array(2), array_values($diff->toArray()));
    }

    public function testMerge()
    {
        $objectA = new Collection(array('A' => 'A', 'B' => 'B'));
        $objectB = new Collection(array('B' => 'B', 'C' => 'C'));

        $merged = $objectA->merge($objectB);
        $this->assertEquals(array('A' => 'A', 'B' => 'B', 'C' => 'C'), $merged->toArray());
    }

    public function testUnique()
    {
        $object = new Collection(array(1, 1, 2, 3, 3));
        $unique = $object->unique();

        $this->assertEquals(array(1, 2, 3), array_values($unique->toArray()));
    }

    public function testJoin()
    {
        $object = new Collection(array('hello', 'world', '!'));
        $this->assertEquals('hello world !', $object->join(' '));
    }

    public function testIterator()
    {
        $object = new Collection(array(1, 2, 3));
        $array = iterator_to_array($object);

        $this->assertEquals(array(1, 2, 3), $array);
    }

}
