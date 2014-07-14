<?php

use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\XmlRoot("TestModel")
 */
class TestModel
{
    /**
     * @JMS\SerializedName("Member")
     * @JMS\Type("string")
     */
    private $amember;

    function __construct($val)
    {
        $this->amember = $val;
    }
}