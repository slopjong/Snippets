#!/usr/bin/env php

<?php

class DummyData
{
    public function data()
    {
        return rand(0,100);
    }
}

class DummyData1
{
    public function data()
    {
        return 0;
    }
}

class PluginProcessor
{
    private $plugins = array();
    
    public function run()
    {
        $plugin_processor = $this;
        require_once("plugin_1.php");
        
        foreach($this->plugins as $plugin)
            $result = call_user_func_array(
                $plugin,
                array(new DummyData, new DummyData)
            );
            
            echo "\n\nCool. The first number is "
                . ($result ? "smaller" : "bigger")
                . " than the second number";
    }
    
    public function register($plugin_name)
    {
        $this->plugins[] = $plugin_name;
    }
}

$plugin_processer = new PluginProcessor;
$plugin_processer->run();