<?php

include('spyc.php');

$yml = <<<YAML
string11:
  string12: string13
  
string21: >
  string22
YAML;

// YAMLLoad accepts either a string or a file
$mapping = Spyc::YAMLLoad($yml);
print_r($mapping);

/*
The output should look like:

Array
(
    [string11] => Array
        (
            [string12] => string13
        )

    [string21] => string22
)
*/