<?php

namespace KzykHys\Iterator;

/**
 * TreeIterator.php
 * 
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */ 
class TreeIterator extends \RecursiveIteratorIterator
{

    private $prefix = '';
    private $postfix = '';

    private $beforeElement;
    private $afterElement;
    private $beforeChildren;
    private $afterChildren;

    /**
     * @param \Closure|string $afterChildren
     *
     * @return $this
     */
    public function afterChildren($afterChildren)
    {
        $this->afterChildren = $afterChildren;

        return $this;
    }

    /**
     * @param \Closure|string $afterElement
     *
     * @return $this
     */
    public function afterElement($afterElement)
    {
        $this->afterElement = $afterElement;

        return $this;
    }

    /**
     * @param \Closure|string $beforeChildren
     *
     * @return $this
     */
    public function beforeChildren($beforeChildren)
    {
        $this->beforeChildren = $beforeChildren;

        return $this;
    }

    /**
     * @param \Closure|string $beforeElement
     *
     * @return $this
     */
    public function beforeElement($beforeElement)
    {
        $this->beforeElement = $beforeElement;

        return $this;
    }

    /**
     * @return string
     */
    public function current()
    {
        $this->prefix .= $this->getString($this->beforeElement);
        $this->postfix .= $this->getString($this->afterElement);

        $string = $this->prefix . (string) parent::current();

        if (!$this->callHasChildren()) {
            $string .= $this->postfix;
        }

        $this->prefix = '';
        $this->postfix = '';

        return $string;
    }

    /**
     * {@inheritdoc}
     */
    public function beginChildren()
    {
        $this->prefix .= $this->getString($this->beforeChildren);
    }

    /**
     * {@inheritdoc}
     */
    public function endChildren()
    {
        $this->prefix .= $this->getString($this->afterChildren);
        $this->prefix .= $this->getString($this->afterElement);
    }

    /**
     * @param \Closure|string $string
     *
     * @return string
     */
    protected function getString($string)
    {
        if ($string instanceof \Closure) {
            $string = (string) call_user_func($string, $this);
        }

        return $string;
    }

}
