<?php

namespace KzykHys\PHPCollection\Collection;

use KzykHys\PHPCollection\ArrayAccess\ArrayObjectTrait;

trait CollectionTrait
{

    use ArrayObjectTrait;

    /**
     * Sets the value at the specified index
     *
     * @param string $index  The index with the value
     * @param mixed  $value  The new value for the index
     *
     * @return CollectionInterface This method is chainable
     */
    public function set($index, $value)
    {
        $this[$index] = $value;
    }

    /**
     * Appends the value
     *
     * @param mixed $value The value being appended
     *
     * @return CollectionInterface This method is chainable
     */
    public function add($value)
    {
        $this[] = $value;

        return $this;
    }

    /**
     * Returns the value at the specified index
     *
     * @param string     $index   The index with the value
     * @param mixed|null $default [optional] The default value if specified key is invalid
     *
     * @return mixed The value at the specified index or default.
     */
    public function get($index, $default = null)
    {
        if ($this->exists($index)) {
            return $this[$index];
        }

        return $default;
    }

    /**
     * Checks if the given key or index exists in the array
     *
     * @param string $index
     *
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function exists($index)
    {
        return $this->offsetExists($index);
    }

    /**
     * Checks if the given value exists in the array
     *
     * @param mixed $value The value to search
     *
     * @return boolean
     */
    public function contains($value)
    {
        return $this->indexOf($value) !== false;
    }

    /**
     * Remove the value at the specified index
     *
     * @param string $index The index being removed
     *
     * @return CollectionInterface This method is chainable
     */
    public function remove($index)
    {
        $this->offsetUnset($index);

        return $this;
    }

    /**
     * Remove the value
     *
     * @param mixed $value The value being removed
     *
     * @return CollectionInterface This method is chainable
     */
    public function removeElement($value)
    {
        if (($index = $this->indexOf($value)) !== false) {
            $this->remove($index);
        }

        return $this;
    }

    /**
     * Returns first element
     *
     * @return mixed The first element
     */
    public function first()
    {
        return reset($this->objects);
    }

    /**
     * Returns last element
     *
     * @return mixed The last element
     */
    public function last()
    {
        return end($this->objects);
    }

    /**
     * Returns the index of given element
     *
     * @param mixed $value The index for value
     *
     * @return mixed The index
     */
    public function indexOf($value)
    {
        return array_search($value, $this->objects, true);
    }

    /**
     * Applies the callback to the elements and creates new collection
     *
     * @param callable $callback
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function each(callable $callback)
    {
        return new static(array_map($callback, $this->objects));
    }

    /**
     * Filters elements using a callback function and creates new collection
     *
     * @param callable $callback
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function filter(callable $callback)
    {
        return new static(array_filter($this->objects, $callback));
    }

    /**
     * Computes the difference of collection
     *
     * @param CollectionInterface $collection,... The collection to compare against
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function diff(CollectionInterface $collection)
    {
        return new static(array_diff($this->objects, $collection->toArray()));
    }

    /**
     * Merge one or more collections
     *
     * @param CollectionInterface $collection,... The collection to merge
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function merge(CollectionInterface $collection)
    {
        return new static(array_merge($this->objects, $collection->toArray()));
    }

    /**
     * Removes duplicate values
     *
     * @param int $flags [optional] The sorting behavior {@see http://php.net/manual/en/function.array-unique.php}
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function unique($flags = SORT_STRING)
    {
        return new static(array_unique($this->objects, $flags));
    }

    /**
     * Join elements with a string
     *
     * @param string $char The string to join with
     *
     * @return string Returns a string containing a string representation of all the elements in the same order, with $char between each element.
     */
    public function join($char = '')
    {
        return implode($char, $this->each(function($value) {
            return (string) $value;
        })->toArray());
    }

    /**
     * Returns all the keys
     *
     * @return array An array of all the keys
     */
    public function keys()
    {
        return array_keys($this->objects);
    }

    /**
     * Returns all the values
     *
     * @return array An array of all the values
     */
    public function values()
    {
        return array_values($this->objects);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->objects);
    }

}