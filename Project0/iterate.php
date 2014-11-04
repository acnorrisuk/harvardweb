<?php 


//Iterate over all 'name' items and echo out

$xml = simplexml_load_file("menu.xml");

$pizzas = $xml->xpath("pizza/name");

	foreach($pizzas as $pizza)
	{
		echo "<li>$pizza<br/>";
	};

?>
