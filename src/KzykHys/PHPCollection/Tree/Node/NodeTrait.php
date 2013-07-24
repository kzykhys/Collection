<?php

namespace KzykHys\PHPCollection\Tree\Node;

use KzykHys\PHPCollection\Tree\TreeCollection;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
trait NodeTrait
{

    /**
     * @var TreeCollection
     */
    protected $children = null;

    /**
     * Returns if an iterator can be created fot the current entry
     *
     * @return boolean
     */
    public function hasChildren()
    {
        return isset($this->children) && count($this->children);
    }

    /**
     * Returns an iterator for the current entry.
     *
     * @return TreeCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

}