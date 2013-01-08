<?php

namespace KzykHys\Collection;

/**
 * Tree.php
 * 
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */ 
class Tree extends AbstractCollection implements \RecursiveIterator
{

    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @param callable $closure The callback to apply
     * @param int      $mode [optional] Optional mode
     *
     * @return $this
     */
    public function each(\Closure $closure, $mode = \RecursiveIteratorIterator::SELF_FIRST)
    {
        foreach ($it = $this->getIterator($mode) as $value) {
            call_user_func($closure, $value, $it);
        }

        return $this;
    }

    /**
     * Return the current element
     *
     * @return mixed Can return any type.
     */
    public function current()
    {
        return current($this->objects);
    }

    /**
     * Move forward to next element
     */
    public function next()
    {
        next($this->objects);
    }

    /**
     * Return the key of the current element
     *
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return key($this->objects);
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean Returns true on success or false on failure.
     */
    public function valid()
    {
        return !is_null(key($this->objects));
    }

    /**
     * Rewind the Iterator to the first element
     */
    public function rewind()
    {
        reset($this->objects);
    }

    /**
     * Returns the inner iterator for the current entry.
     *
     * @param int $mode [optional] Optional mode
     *
     * @return \Iterator The inner iterator for the current entry.
     */
    public function getIterator($mode = \RecursiveIteratorIterator::SELF_FIRST)
    {
        return new \RecursiveIteratorIterator($this, $mode);
    }

    /**
     * Returns if an iterator can be created for the current entry.
     *
     * @return bool true if the current entry can be iterated over, otherwise returns false.
     */
    public function hasChildren()
    {
        return $this->current() instanceof Tree && count($this->current());
    }

    /**
     * Returns an iterator for the current entry.
     *
     * @return \RecursiveIterator An iterator for the current entry.
     */
    public function getChildren()
    {
        return $this->current();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return spl_object_hash($this);
    }

}
