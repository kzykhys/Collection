<?php

namespace KzykHys\PHPCollection\Tree\Node;

use KzykHys\PHPCollection\Tree\TreeCollection;

/**
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */
abstract class AbstractNode implements NodeInterface
{

    use NodeTrait;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new TreeCollection();
    }

}