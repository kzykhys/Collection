<?php

namespace KzykHys\PHPCollection\ArrayAccess;

trait ArrayObjectTrait
{

    use ArrayAccessTrait;

    /**
     * Returns object as an array
     *
     * @return array
     */
    public function toArray()
    {
        return $this->objects;
    }

}