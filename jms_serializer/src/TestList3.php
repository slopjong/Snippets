<?php

use \Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\ClosureExpressionVisitor;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("TestList3")
 */
class TestList3 extends AbstractList
{
    /**
     * @JMS\XmlList(inline = true, entry = "Test")
     * @JMS\Type("ArrayCollection<string>")
     */
    protected $list;

    function __construct()
    {
        $this->list = new ArrayCollection();
        $this->list->add('test1');
        $this->list->add('test2');
        $this->list->add('test3');
    }
}