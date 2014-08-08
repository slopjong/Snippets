<?php

exec('ip address', $nic_lines);

$nics = array();
$nic = array();
while(! is_null($line = array_pop($nic_lines)))
{
    $nic[] = $line;

    if(preg_match("/^\d+:/", $line))
    {
        $nics[] = array_reverse($nic);
        $nic = array();
    }
}

for($i=0; $i<count($nics); $i++)
{
    $nic_string = join(' ', $nics[$i]);
    preg_match("/inet\s+((\d{1,3}.){3,3}\d{1,3})/", $nic_string, $matches);
    @$ip = $matches[1];

    preg_match("/^\d: ([^:]+)/", $nic_string, $matches);
    @$nic_name = $matches[1];

    preg_match("/link\/ether ([^ ]+)/", $nic_string, $matches);
    @$mac_address = $matches[1];

    echo "$nic_name: $ip (MAC: $mac_address)\n";
}

//foreach($nic_lines as $line)
//{
//    if(preg_match("/^\d+:/", $line))
//    {
//
//    }
//}

//echo "===================\n";
//print_r($nic);