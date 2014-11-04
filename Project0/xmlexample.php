<?php
$xml = simplexml_load_file("testlist.xml");

//$xmldata = simplexml_load_string($xmlString);


//Once this is done, all we have to do is use the simple PHP foreach loop:

foreach($xml->xpath('item') as $item)
{
        echo $item->name;
        echo $item->price;
}
?>