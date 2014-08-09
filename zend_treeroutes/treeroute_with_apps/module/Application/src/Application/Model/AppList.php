<?php

namespace Application\Model;

use Application\Constants\Directory;
use Doctrine\Common\Collections\ArrayCollection;

class AppList extends ArrayCollection
{
    function __construct()
    {
        $appdir = realpath(__DIR__ . '/../../../../..' . Directory::APP);

        $metafiles = glob($appdir . "/*/.meta*");

        foreach($metafiles as $file)
        {
            $xml = file_get_contents($file);
            $simplexml = new \SimpleXMLElement($xml);

            if(preg_match("|/apps/(\d+)|", $file, $matches))
            {
                $appid = (int) $matches[1];
                $this->add(new App($appid));
            }
        }
    }
}