<?php

use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as JMS;

/**
 * @JMS\AccessorOrder("alphabetical")
 * @JMS\XmlRoot("Cps")
 */
class Model
{
    /**
     * @JMS\SerializedName("Name")
     * @JMS\Type("string")
     */
    protected $name = '';

    /**
     * @JMS\SerializedName("Description")
     * @JMS\Type("string")
     */
    protected $description = '';

    /**
     * @JMS\SerializedName("Id")
     * @JMS\Type("integer")
     */
    protected $id;

    /**
     * @JMS\SerializedName("DefaultNic")
     * @JMS\Type("string")
     */
    protected $default_nic = '';

    /**
     * @JMS\SerializedName("Ip")
     * @JMS\Type("string")
     */
    protected $ip = '';

    /**
     * @JMS\SerializedName("InterfaceList")
     * @JMS\XmlList(inline = false, entry = "Interface")
     * @JMS\Type("array<string>")
     */
    protected $interfaces = array();

    /**
     * @JMS\SerializedName("EmptyArray")
     * @JMS\XmlList(inline = false, entry = "Entry")
     * @JMS\Type("array<string>")
     */
    protected $empty_array = array();

    function __construct()
    {
        $this->name = "Name";
        $this->description = "Description";
        $this->id = 1;
        $this->default_nic = "DefaultNic";
        $this->ip = "Ip";

        $this->interfaces[] = "test1";
        $this->interfaces[] = "test2";
        $this->interfaces[] = "test3";
    }
}