<?php

namespace KzykHys\PHPCollection\Tree;

class Tree implements \IteratorAggregate
{

    /**
     * @var TreeCollection
     */
    private $collection;

    /**
     * @param TreeCollection $collection
     */
    public function __construct(TreeCollection $collection = null)
    {
        if (is_null($collection)) {
            $collection = new TreeCollection();
        }

        $this->collection = $collection;
    }

    /**
     * @param \KzykHys\PHPCollection\Tree\TreeCollection $collection
     *
     * @return $this
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;

        return $this;
    }

    /**
     * @return \KzykHys\PHPCollection\Tree\TreeCollection
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param callable $callback function(mixed $key, mixed $value, int $depth)
     */
    public function each(callable $callback)
    {
        $iterator = $this->getIterator();

        foreach ($iterator as $key => $value) {
            call_user_func_array($callback, array($key, $value, $iterator->getDepth()));
        }
    }

    /**
     * Retrieve an external iterator
     *
     * @return \RecursiveIteratorIterator
     */
    public function getIterator()
    {
        return new \RecursiveIteratorIterator($this->collection, \RecursiveIteratorIterator::SELF_FIRST);
    }

}
