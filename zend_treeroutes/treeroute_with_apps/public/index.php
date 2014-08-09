<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

define("APPLICATION_PATH", dirname(__DIR__));
chdir(APPLICATION_PATH);

function dump($mixed, $is_html = false)
{
    if($is_html)
        echo "<pre>" . htmlspecialchars(print_r($mixed, true)) . "</pre>";
    else
        echo "<pre>" . print_r($mixed, true) . "</pre>";
}

function dumpx($mixed)
{
    dump($mixed);
    exit();
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
$application = Zend\Mvc\Application::init(
    require 'config/application.config.php'
);

$application->run();
