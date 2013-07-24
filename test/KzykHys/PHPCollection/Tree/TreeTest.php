<?php

require_once __DIR__ . '/Stub/StubNode.php';

use KzykHys\PHPCollection\Tree\Tree;
use KzykHys\PHPCollection\Tree\TreeCollection;

class TreeTest extends \PHPUnit_Framework_TestCase
{

    public function testTreeAsAContainer()
    {
        $tree = new Tree();

        $collection = $tree->getCollection();
        $collection->add(1);
        $tree->setCollection($collection);
    }

    public function testRecursiveIteration()
    {
        $node = new StubNode('node1');
        $node->getChildren()
            ->add(new StubNode('node1-1'))
            ->add(new StubNode('node1-2'));

        $tree = new Tree(new TreeCollection(array(
            $node,
            new StubNode('node2'),
            'node3'
        )));

        $result = array();

        foreach ($tree as $node) {
            $result[] = (string) $node;
        }

        $this->assertEquals(array('node1', 'node1-1', 'node1-2', 'node2', 'node3'), $result);
    }

    public function testEach()
    {
        $node = new StubNode('node1');
        $node->getChildren()
            ->add(new StubNode('node1-1'))
            ->add(new StubNode('node1-2'));

        $tree = new Tree(new TreeCollection(array(
            $node,
            new StubNode('node2'),
            'node3'
        )));

        $result = array();

        $tree->each(function ($key, $value, $depth) use (&$result) {
            $result[] = $depth . ':' . (string)$value;
        });

        $this->assertEquals(array('0:node1', '1:node1-1', '1:node1-2', '0:node2', '0:node3'), $result);
    }


}