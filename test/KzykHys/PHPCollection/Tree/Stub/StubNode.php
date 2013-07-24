<?php

class StubNode extends \KzykHys\PHPCollection\Tree\Node\AbstractNode
{

    /**
     * @var string
     */
    private $string;

    public function __construct($string)
    {
        parent::__construct();
        $this->string = $string;
    }

    public function __toString()
    {
        return $this->string;
    }

}