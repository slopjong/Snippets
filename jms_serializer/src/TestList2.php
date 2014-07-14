<?php

use \Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\ClosureExpressionVisitor;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("TestList2")
 * @JMS\ExclusionPolicy("none")
 *
 */
class TestList2 extends ArrayCollection
{
    /**
     * @JMS\Type("array")
     */
    private $_elements;

    /**
     * @JMS\XmlList(inline = true, entry = "Test")
     * @JMS\Type("ArrayCollection<string>")
     */
    private $list;

    function __construct()
    {
        $this->list = new ArrayCollection();
        $this->list->add('test1');
        $this->list->add('test2');
        $this->list->add('test3');
    }

    public function __toString()
    {
        return $this->list->__toString();
    }

    public function toArray()
    {
        return $this->list->toArray();
    }

    public function first()
    {
        return $this->listfirst();
    }

    public function last()
    {
        return $this->listlast();
    }

    public function key()
    {
        return $this->listkey();
    }

    public function next()
    {
        return $this->listnext();
    }

    public function current()
    {
        return $this->listcurrent();
    }

    public function remove($key)
    {
        return $this->listremove($key);
    }

    public function removeElement($element)
    {
        return $this->listremoveElement($element);
    }

    public function offsetExists($offset)
    {
        return $this->listoffsetExists($offset);
    }

    public function offsetGet($offset)
    {
        return $this->listoffsetGet($offset);
    }

    public function offsetSet($offset, $value)
    {
        return $this->listoffsetSet($offset, $value);
    }

    public function offsetUnset($offset)
    {
        return $this->listoffsetUnset($offset);
    }

    public function containsKey($key)
    {
        return $this->listcontainsKey($key);
    }

    public function contains($element)
    {
        return $this->listcontains($element);
    }

    public function exists(Closure $p)
    {
        return $this->listexists($p);
    }

    public function indexOf($element)
    {
        return $this->listindexOf($element);
    }

    public function get($key)
    {
        return $this->listget($key);
    }

    public function getKeys()
    {
        return $this->listgetKeys();
    }

    public function getValues()
    {
        return $this->listgetValues();
    }

    public function count()
    {
        return $this->listcount();
    }

    public function set($key, $value)
    {
        $this->listset($key, $value);
    }

    public function add($value)
    {
        return $this->listadd($value);
    }

    public function isEmpty()
    {
        return $this->listisEmpty();
    }

    public function getIterator()
    {
        return $this->listgetIterator();
    }

    public function map(Closure $func)
    {
        return $this->listmap($func);
    }

    public function filter(Closure $p)
    {
        return $this->listfilter($p);
    }

    public function forAll(Closure $p)
    {
        return $this->listforAll($p);
    }

    public function partition(Closure $p)
    {
        return $this->listpartition($p);
    }

    public function clear()
    {
        $this->listclear();
    }

    public function slice($offset, $length = null)
    {
        return $this->listslice($offset, $length);
    }

    public function matching(Criteria $criteria)
    {
        return $this->listmatching($criteria);
    }

}