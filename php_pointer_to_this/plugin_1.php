<?php

function plugin_1($data1, $data2)
{
    $val1 = $data1->data();
    $val2 = $data2->data();
    
    echo $val1 ." < ". $val2 . " = ";
    echo ($val1 < $val2) ? "1" : "0";
    
    return ($val1 < $val2);
}

$plugin_processor->register('plugin_1');