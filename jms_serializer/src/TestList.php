<?php

use \Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("TestList")
 * @JMS\ExclusionPolicy("none")
 */
class TestList extends ArrayCollection
{
    // We need to redefine _elements so that the exclusion policy takes
    // effect
    /**
     * @JMS\Type("array")
     */
    private $_elements;

    function __construct()
    {
        $this->add('test1');
        $this->add('test2');
        $this->add('test3');
    }

    /**
     * @JMS\XmlList(inline = true, entry = "Test")
     * @JMS\VirtualProperty
     * @return array
     */
    public function toArray()
    {
        return parent::toArray();
    }

    /**
     * @JMS\HandlerCallback("xml", direction = "deserialization")
     */
    public function fromXml(\JMS\Serializer\XmlDeserializationVisitor $visitor)
    {
        dump("Own handler callback for deserialization");
    }

}