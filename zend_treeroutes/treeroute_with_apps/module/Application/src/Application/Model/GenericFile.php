<?php

namespace Application\Model;

class GenericFile
{
    private static $mimes = array(
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'html' => 'text/html',
        'css' => 'text/css',
        'javascript' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'xsd' => 'application/xml'
    );

    public static function mimetype($file)
    {
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        if(isset(self::$mimes[$extension]))
            return self::$mimes[$extension];
        else
            return "";
    }
}