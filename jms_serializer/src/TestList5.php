<?php

use \Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Expr\ClosureExpressionVisitor;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("TestList5")
 */
class TestList5 extends AbstractList
{
    /**
     * @JMS\XmlList(inline = true, entry = "TestModel")
     * @JMS\Type("ArrayCollection<TestModel>")
     */
    protected $list;

    function __construct()
    {
        $this->list = new ArrayCollection();
        $this->list->add(new TestModel('test1'));
        $this->list->add(new TestModel('test2'));
        $this->list->add(new TestModel('test3'));
    }
}