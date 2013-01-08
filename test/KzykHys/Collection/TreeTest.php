<?php

use KzykHys\Collection\Tree;

/**
 * TreeTest.php
 * 
 * @author Kazuyuki Hayashi <hayashi@valnur.net>
 */ 
class TreeTest extends \PHPUnit_Framework_TestCase
{

    public function testIterator()
    {
        $tree = new Tree(array(1, 2, 3, 4));

        $this->assertEquals(array(1, 2, 3, 4), iterator_to_array($tree));
    }

    public function testRecursiveIterator()
    {
        $tree = new Tree(array(
            new Tree(array(1, 2, 3, 4)),
            5, 6, 7, 8
        ));

        foreach ($it = $tree->getIterator(\RecursiveIteratorIterator::LEAVES_ONLY) as $value) {
            $this->assertInternalType('integer', $value);
        }
    }

    public function testTraversing()
    {
        $tree = new Tree(array(
            new Tree(array(1, 2, 3, 4)),
            5, 6, 7, 8
        ));

        $tree->each(function($val, \RecursiveIteratorIterator $iterator) {
            return true;
        });
    }

    public function testToString()
    {
        $this->assertInternalType('string', (string) new Tree());
    }

    public function skippedTestGenerateDomTree()
    {
        $this->markTestSkipped();

        $tree = new HtmlLinkListTree();
        $tree->add(new HtmlLinkListTree('#', 'Item1', array(new HtmlLinkListTree('#', 'Item1-1'))));
        $tree->add(new HtmlLinkListTree('#', 'Item2', array(new HtmlLinkListTree('#', 'Item2-1'), new HtmlLinkListTree('#', 'Item2-2'))));

        $tree->before(function ($it) {
            echo str_repeat(' ', ($it->getDepth() * 2));
            echo '<ul>'."\n";
        });
        $tree->after(function ($it, $finished) {
            echo str_repeat(' ', ($it->getDepth() * 2));
            echo '</ul>'."\n";
            if (!$finished) {
                echo str_repeat(' ', ($it->getDepth() * 2));
                echo '</li>'."\n";
            }
        });
        $tree->each(function ($node, \RecursiveIteratorIterator $iterator) {
            echo '  ' . str_repeat(' ', ($iterator->getDepth() * 2));
            echo $node;
            if (count($node) == 0) {
                echo "</li>";
            }
            echo "\n";
        });
    }

}

class HtmlLinkListIterator extends RecursiveIteratorIterator
{
    private $before;
    private $after;

    public function beginIteration()
    {
        if (is_callable($this->before))
        call_user_func($this->before, $this);
    }

    public function endIteration()
    {
        if (is_callable($this->after))
        call_user_func($this->after, $this, true);
    }

    public function beginChildren()
    {
        if (is_callable($this->before))
            call_user_func($this->before, $this);
    }

    public function endChildren()
    {
        if (is_callable($this->after))
            call_user_func($this->after, $this, false);
    }


    public function after(\Closure $after)
    {
        $this->after = $after;

        return $this;
    }

    public function before(\Closure $before)
    {
        $this->before = $before;

        return $this;
    }


}

class HtmlLinkListTree extends Tree
{
    private $href;
    private $text;
    private $before;
    private $after;
    private $start = '<li>';
    private $end = '</li>';

    public function __construct($href = null, $text = null, $objects = array())
    {
        $this->setHref($href);
        $this->setText($text);
        parent::__construct($objects);
    }

    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function after(\Closure $after)
    {
        $this->after = $after;

        return $this;
    }

    public function before(\Closure $before)
    {
        $this->before = $before;

        return $this;
    }

    public function getIterator($mode = \RecursiveIteratorIterator::SELF_FIRST)
    {
        $iterator = new HtmlLinkListIterator($this, $mode);
        $iterator->before($this->before);
        $iterator->after($this->after);

        return $iterator;
    }

    public function __toString()
    {
        return sprintf('%s<a href="%s">%s</a>', $this->start, $this->href, $this->text);
    }

}