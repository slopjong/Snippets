<?php

namespace Application\Model;


use Application\Constants\Directory;

class App
{
    // we shouldn't use public members, this breaks OOP
    public $id = "";
    public $name = "";
    public $icon = "";
    public $description = "";
    public $version = "";
    public $state = "";

    function __construct($appid)
    {
        $appdir = realpath(__DIR__ . '/../../../../..' . Directory::APP);

        if(file_exists($appdir . "/$appid/.metadata"))
        {
            $xml = file_get_contents($appdir . "/$appid/.metadata");

            // unmarshal the xml
            $simplexml = new \SimpleXMLElement($xml);

            $this->id = $appid;
            $this->name = (string) $simplexml->name;
            $this->icon = "/apps/$appid/icon.png";
            $this->description = (string) $simplexml->description;
            $this->version = (string) $simplexml->version;
            $this->state = (string) $simplexml->state;
        }
    }
}