<?php

namespace KzykHys\PHPCollection\MutableCollection;

use KzykHys\PHPCollection\Collection\Collection;
use KzykHys\PHPCollection\Collection\CollectionInterface;

/**
 *
 *
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
class MutableCollection extends Collection
{

    /**
     * Applies the callback to the elements
     *
     * @param callable $callback
     *
     * @return CollectionInterface This method is chainable
     */
    public function each(callable $callback)
    {
        $this->objects = array_map($callback, $this->objects);

        return $this;
    }

    /**
     * Filters elements using a callback function
     *
     * @param callable $callback
     *
     * @return CollectionInterface This method is chainable
     */
    public function filter(callable $callback)
    {
        $this->objects = array_filter($this->objects, $callback);

        return $this;
    }

    /**
     * Merge one or more collections
     *
     * @param CollectionInterface $collection,... The collection to merge
     *
     * @return CollectionInterface This method is chainable
     */
    public function merge(CollectionInterface $collection)
    {
        $this->objects = array_merge($this->objects, $collection->toArray());

        return $this;
    }

    /**
     * Removes duplicate values
     *
     * @param int $flags [optional] The sorting behavior {@see http://php.net/manual/en/function.array-unique.php}
     *
     * @return CollectionInterface This method is chainable
     */
    public function unique($flags = SORT_STRING)
    {
        $this->objects = array_unique($this->objects, $flags);

        return $this;
    }

    /**
     * Offset to retrieve. If specified offset is invalid, generates a new collection with the offset
     *
     * {@see http://php.net/manual/en/arrayaccess.offsetget.php}
     *
     * @param mixed $offset The offset to retrieve.
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            $this->offsetSet($offset, new static());
        }

        return $this->objects[$offset];
    }

}