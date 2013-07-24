<?php

namespace KzykHys\PHPCollection\Collection;

use KzykHys\PHPCollection\ArrayAccess\ArrayObjectInterface;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
class AbstractCollection implements CollectionInterface, ArrayObjectInterface
{

    use CollectionTrait;

    /**
     * @param array $objects
     */
    public function __construct($objects = array())
    {
        $this->objects = $objects;
    }

}