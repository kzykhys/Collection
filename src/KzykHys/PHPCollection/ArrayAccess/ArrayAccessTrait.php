<?php

namespace KzykHys\PHPCollection\ArrayAccess;

/**
 * Helper trait to easily implement PHP's \ArrayAccess interface
 *
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
trait ArrayAccessTrait
{

    /**
     * @var array
     */
    protected $objects = array();

    /**
     * Whether a offset exists
     *
     * {@see http://php.net/manual/en/arrayaccess.offsetexists.php}
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
     * {@see http://php.net/manual/en/arrayaccess.offsetget.php}
     *
     * @param mixed $offset The offset to retrieve.
     *
     * @throws \OutOfBoundsException
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        if (!$this->offsetExists($offset)) {
            throw new \OutOfBoundsException(sprintf('Identifier "%s" is not defined.', $offset));
        }

        return $this->objects[$offset];
    }

    /**
     * Offset to set
     *
     * {@see http://php.net/manual/en/arrayaccess.offsetset.php}
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value  The value to set.
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->objects[] = $value;
        } else {
            $this->objects[$offset] = $value;
        }
    }

    /**
     * Offset to unset
     *
     * {@see http://php.net/manual/en/arrayaccess.offsetunset.php}
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