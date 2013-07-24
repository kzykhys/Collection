<?php

namespace KzykHys\PHPCollection\ArrayAccess;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
interface ArrayObjectInterface extends \ArrayAccess
{

    /**
     * Returns object as an array
     *
     * @return array
     */
    public function toArray();

}