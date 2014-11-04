<?php

//Iterate over all 'name' items and echo out

$xml = simplexml_load_file("menu.xml");

$results = $xml->xpath("pizza/name");

foreach($results as $result)
{
	echo $result . "<br />";
}



?>

