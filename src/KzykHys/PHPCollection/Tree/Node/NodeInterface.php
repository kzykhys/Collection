<?php

namespace KzykHys\PHPCollection\Tree\Node;

use KzykHys\PHPCollection\Tree\TreeCollection;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
interface NodeInterface
{

    /**
     * Returns if an iterator can be created fot the current entry
     *
     * @return boolean
     */
    public function hasChildren();

    /**
     * Returns an iterator for the current entry.
     *
     * @return TreeCollection
     */
    public function getChildren();

}