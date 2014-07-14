<?php

function dump($mixed, $is_html = false)
{
    if($is_html)
        echo "<pre>" . htmlspecialchars(print_r($mixed, true)) . "</pre>";
    else
        echo "<pre>" . print_r($mixed, true) . "</pre>";
}

function dumpx($mixed, $is_html = false)
{
    dump($mixed, $is_html);
    exit();
}

function output_xml($xml)
{
    // We need this step in order to remove the CDATA blocks. See:
    // https://github.com/schmittjoh/JMSSerializerBundle/pull/132
    echo simplexml_load_string($xml, null, LIBXML_NOCDATA )->asXml();
}

/********************************************************************/

if (file_exists('../vendor/autoload.php'))
    $loader = include '../vendor/autoload.php';

// initialize the doctrine autoloader
$namespaces = include '../vendor/composer/autoload_namespaces.php';
\Doctrine\Common\Annotations\AnnotationRegistry::registerAutoloadNamespace("JMS\Serializer", $namespaces['JMS\Serializer']);

$serializer = JMS\Serializer\SerializerBuilder::create()->build();

echo "\n\n######################################################################\n";
echo "# Test 0: Serialization of a model (including two arrays) \n";
echo "######################################################################\n";

include('Model.php');



$model = new Model;
$payload = $serializer->serialize($model, 'xml');

$object = $serializer->deserialize($payload, 'Model', 'xml');
$object_str = print_r($object, true);

output_xml($payload);
echo "----------------------------------------------------------------------\n";
echo $object_str;

echo "\n\n######################################################################\n";
echo "# Test 1: Serialization/Deserialization roundtrip \n";
echo "######################################################################\n";

include('TestList.php');
$list = new TestList;
$xml = $serializer->serialize($list, 'xml');

output_xml($xml);

echo "----------------------------------------------------------------------\n";

$object = $serializer->deserialize($xml, 'TestList', 'xml');
$object_str = print_r($object, true);

echo $object_str;

echo "\n\n######################################################################\n";
echo "# Test 2: Serialization/Deserialization roundtrip\n";
echo "######################################################################\n";

include('TestList2.php');
$list = new TestList2;
$xml = $serializer->serialize($list, 'xml');

output_xml($xml);

echo "----------------------------------------------------------------------\n";

$object = $serializer->deserialize($xml, 'TestList2', 'xml');
$object_str = print_r($object, true);

echo $object_str;


echo "\n\n######################################################################\n";
echo "# Test 3: Serialization/Deserialization roundtrip\n";
echo "######################################################################\n";

include("AbstractList.php");
include('TestList3.php');
$list = new TestList3;
$xml = $serializer->serialize($list, 'xml');

output_xml($xml);

echo "----------------------------------------------------------------------\n";

$object = $serializer->deserialize($xml, 'TestList3', 'xml');
$object_str = print_r($object, true);

echo $object_str;

echo "----------------------------------------------------------------------\n";

$xml = $serializer->serialize($object, 'xml');

output_xml($xml);

echo "\n\n######################################################################\n";
echo "# Test 4: Serialization/Deserialization roundtrip\n";
echo "######################################################################\n";

include('TestList4.php');
$list = new TestList4;

$xml = $serializer->serialize($list, 'xml');

output_xml($xml);

echo "----------------------------------------------------------------------\n";

$object = $serializer->deserialize($xml, 'TestList4', 'xml');
$object_str = print_r($object, true);

echo $object_str;

echo "----------------------------------------------------------------------\n";

$xml = $serializer->serialize($object, 'xml');
output_xml($xml);


echo "\n\n######################################################################\n";
echo "# Test 5: Serialization of an ArrayCollection with elements of a complex data type\n";
echo "######################################################################\n";

include('TestModel.php');
include('TestList5.php');
$list = new TestList5;

$xml = $serializer->serialize($list, 'xml');
output_xml($xml);

echo "----------------------------------------------------------------------\n";

$object = $serializer->deserialize($xml, 'TestList5', 'xml');
$object_str = print_r($object, true);

echo $object_str;

echo "----------------------------------------------------------------------\n";

$xml = $serializer->serialize($object, 'xml');
output_xml($xml);

echo "----------------------------------------------------------------------\n";

output_xml($serializer->serialize(new TestModel('a test model'), 'xml'));