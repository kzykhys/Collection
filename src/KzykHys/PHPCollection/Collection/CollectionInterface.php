<?php

namespace KzykHys\PHPCollection\Collection;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
interface CollectionInterface extends \Countable
{

    /**
     * Sets the value at the specified index
     *
     * @param string $index  The index with the value
     * @param mixed  $value The new value for the index
     *
     * @return CollectionInterface This method is chainable
     */
    public function set($index, $value);

    /**
     * Appends the value
     *
     * @param mixed $value The value being appended
     *
     * @return CollectionInterface This method is chainable
     */
    public function add($value);

    /**
     * Returns the value at the specified index
     *
     * @param string $index The index with the value
     * @param mixed|null  $default [optional] The default value if specified key is invalid
     *
     * @return mixed The value at the specified index or default.
     */
    public function get($index, $default = null);

    /**
     * Checks if the given key or index exists in the array
     *
     * @param string $index
     *
     * @return boolean Returns TRUE on success or FALSE on failure.
     */
    public function exists($index);

    /**
     * Checks if the given value exists in the array
     *
     * @param mixed $value The value to search
     *
     * @return boolean
     */
    public function contains($value);

    /**
     * Remove the value at the specified index
     *
     * @param string $index The index being removed
     *
     * @return CollectionInterface This method is chainable
     */
    public function remove($index);

    /**
     * Remove the value
     *
     * @param mixed $value The value being removed
     *
     * @return CollectionInterface This method is chainable
     */
    public function removeElement($value);

    /**
     * Returns first element
     *
     * @return mixed The first element
     */
    public function first();

    /**
     * Returns last element
     *
     * @return mixed The last element
     */
    public function last();

    /**
     * Returns the index of given element
     *
     * @param mixed $value The index for value
     *
     * @return mixed The index
     */
    public function indexOf($value);

    /**
     * Applies the callback to the elements and creates new collection
     *
     * @param callable $callback
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function each(callable $callback);

    /**
     * Filters elements using a callback function and creates new collection
     *
     * @param callable $callback
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function filter(callable $callback);

    /**
     * Computes the difference of collection
     *
     * @param CollectionInterface $collection,... The collection to compare against
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function diff(CollectionInterface $collection);

    /**
     * Merge one or more collections
     *
     * @param CollectionInterface $collection,... The collection to merge
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function merge(CollectionInterface $collection);

    /**
     * Removes duplicate values
     *
     * @param int $flags [optional] The sorting behavior {@see http://php.net/manual/en/function.array-unique.php}
     *
     * @return CollectionInterface This method creates new instance of collection
     */
    public function unique($flags = SORT_STRING);

    /**
     * Join elements with a string
     *
     * @param string $char The string to join with
     * @return string Returns a string containing a string representation of all the elements in the same order, with $char between each element.
     */
    public function join($char = '');

    /**
     * Returns all the keys
     *
     * @return array An array of all the keys
     */
    public function keys();

    /**
     * Returns all the values
     *
     * @return array An array of all the values
     */
    public function values();

    /**
     * Returns collection as an array
     *
     * @return array
     */
    public function toArray();

}