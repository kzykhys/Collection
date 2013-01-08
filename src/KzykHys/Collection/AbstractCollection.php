<?php

namespace KzykHys\Collection;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */ 
abstract class AbstractCollection implements \Countable, \ArrayAccess
{

    /**
     * @var array
     */
    protected $objects = array();

    /**
     * @param array $objects
     */
    public function __construct(array $objects = array())
    {
        $this->objects = $objects;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->objects[$key] = $value;

        return $this;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function add($value)
    {
        $this->objects[] = $value;

        return $this;
    }

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->objects[$key];
    }

    /**
     * @return mixed
     */
    public function first()
    {
        return reset($this->objects);
    }

    /**
     * @return mixed
     */
    public function last()
    {
        return end($this->objects);
    }

    /**
     * Filters elements of an array using a callback function
     *
     * @param callable $closure The callback function to use
     *
     * {@link http://php.net/manual/en/function.array-filter.php}
     *
     * @return static
     */
    public function filter(\Closure $closure)
    {
        return new static(array_filter($this->objects, $closure));
    }

    /**
     * @param callable $closure
     *
     * @return static
     */
    public function map(\Closure $closure)
    {
        return new static(array_map($closure, $this->objects));
    }

    /**
     * @param Collection $collection
     *
     * @return static
     */
    public function diff(Collection $collection)
    {
        return new static(array_diff($this->objects, $collection->objects));
    }

    /**
     * @param Collection $collection
     *
     * @return static
     */
    public function merge(Collection $collection)
    {
        return new static(array_merge($this->objects, $collection->objects));
    }

    /**
     * @param int $flag
     *
     * @return static
     */
    public function unique($flag = SORT_REGULAR)
    {
        return new static(array_unique($this->objects, $flag));
    }

    /**
     * @param string $char
     *
     * @return string
     */
    public function join($char = '')
    {
        return implode($char, $this->map(function($value) {
            return (string) $value;
        })->toArray());
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->objects;
    }

    /**
     * Count elements of an object
     *
     * @return integer The count as an integer.
     */
    public function count()
    {
        return count($this->objects);
    }

    /**
     * Whether a offset exists
     *
     * @param mixed $offset An offset to check for.
     *
     * @return boolean true on success or false on failure.
     */
    public function offsetExists($offset)
    {
        return isset($this->objects[$offset]);
    }

    /**
     * Offset to retrieve
     *
     * @param mixed $offset The offset to retrieve.
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * Offset to set
     *
     * @param mixed $offset The offset to set
     * @param mixed $value  The value to set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->add($value);
        } else {
            $this->set($offset, $value);
        }
    }

    /**
     * Offset to unset
     *
     * @param mixed $offset The offset to unset.
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->objects[$offset]);
    }

}
