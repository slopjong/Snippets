<?php

use \Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("TestList4")
 */
class TestList4 extends ArrayCollection
{
    /**
     * @JMS\XmlList(inline = true, entry = "Test")
     * @JMS\Type("array<string>")
     */
    private $_elements = array();

    function __construct()
    {
        $this->add('test1');
        $this->add('test2');
        $this->add('test3');
    }
}