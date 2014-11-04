	<?php 
		
//	function iterate_pizzas($item)
	//{
		//Iterate over items in XML and echo out in HTML list

		$xml = simplexml_load_file("menu.xml");
		//$items = $xml->xpath("category/$item"); // e.g pizza
		foreach($xml->xpath('category/pizza') as $item)
		{
			echo "<li>";
			echo $item->name . " small: <button>ADD</button>";
			echo $item->small . " large: ";
			echo $item->large;
			echo "<button>ADD</button></li>";
	
		};
//	};
	
	
	
	?>