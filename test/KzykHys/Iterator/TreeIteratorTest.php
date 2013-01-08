<?php

use KzykHys\Collection\Tree;
use KzykHys\Iterator\TreeIterator;

/**
 * TreeIteratorTest.php
 * 
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */ 
class TreeIteratorTest extends \PHPUnit_Framework_TestCase
{

    public function testIterator()
    {
        $tree = new Tree(array(
            new Tree(array(
                1,
                2,
                new Tree(array(
                    3.0, 3.1, 3.2
                )),
                4
            )),
            5, 6, 7, 8
        ));

        $iterator = new TreeIterator($tree);
        $iterator
            ->beforeElement('<li>')
            ->afterElement('</li>')
            ->beforeChildren(function () { return '<ul>'; })
            ->afterChildren('</ul>');

        foreach ($iterator as $value) {
            echo $value . "\n";
        }
    }

}