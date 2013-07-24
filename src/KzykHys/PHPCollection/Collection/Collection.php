<?php

namespace KzykHys\PHPCollection\Collection;

use KzykHys\PHPCollection\ArrayAccess\ArrayAccessTrait;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
class Collection extends AbstractCollection implements \IteratorAggregate
{

    /**
     * Retrieve an external iterator
     *
     * {@see http://php.net/manual/en/iteratoraggregate.getiterator.php}
     *
     * @return \Traversable An instance of an object implementing **Iterator** or **Traversable**
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->objects);
    }

}