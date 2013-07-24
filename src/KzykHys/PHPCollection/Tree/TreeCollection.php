<?php

namespace KzykHys\PHPCollection\Tree;

use KzykHys\PHPCollection\Collection\AbstractCollection;
use KzykHys\PHPCollection\Tree\Node\NodeInterface;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
class TreeCollection extends AbstractCollection implements \RecursiveIterator
{

    /**
     * @var int
     */
    private $position = 0;

    /**
     * Return the current element
     *
     * @return mixed Can return any type.
     */
    public function current()
    {
        $keys = array_keys($this->objects);

        return $this->objects[$keys[$this->position]];
    }

    /**
     * Move forward to next element
     *
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * Return the key of the current element
     *
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        $keys = array_keys($this->objects);

        return $keys[$this->position];
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean The return value will be casted to boolean and then evaluated. Returns true on success or false on failure.
     */
    public function valid()
    {
        $keys = array_keys($this->objects);

        return isset($keys[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Returns if an iterator can be created for the current entry.
     *
     * @return bool true if the current entry can be iterated over, otherwise returns false.
     */
    public function hasChildren()
    {
        $node = $this->current();

        if ($node instanceof NodeInterface) {
            return $node->hasChildren();
        }

        return false;
    }

    /**
     * Returns an iterator for the current entry.
     *
     * @return TreeCollection An iterator for the current entry.
     */
    public function getChildren()
    {
        return $this->current()->getChildren();
    }

}