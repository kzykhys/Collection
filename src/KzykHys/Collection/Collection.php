<?php

namespace KzykHys\Collection;

/**
 * Collection.php
 * 
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */ 
class Collection extends AbstractCollection implements \IteratorAggregate
{

    /**
     * Retrieve an external iterator
     *
     * @return \Traversable An instance of an object implementing <b>Iterator</b> or <b>Traversable</b>
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->objects);
    }

}
