<?php session_start();?>
<!DOCTYPE html>
<html>

<head>

<meta charset="utf-8">
<script src="jquery.js"></script>

 <script src="jqueryui/js/jquery-1.10.2.js"></script>
 <script src="jqueryui/js/jquery-ui-1.10.4.js"></script>

<!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">  

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

	 <link rel="stylesheet" href="jqueryui/css/ui-lightness/jquery-ui-1.10.4.css">
	 <link rel="stylesheet" href="style.css">
<?php 

	
		
	function iterate_single_size($type)
	{
		//Iterate over item names in XML and echo out as list items in HTML

		$xml = simplexml_load_file("menu.xml");
		//$items = $xml->xpath("category/$type/name"); saved as variable
		foreach($xml->xpath("category/$type") as $item)
		{
			echo "<table>";
			echo "<tr><td class='name'>" . $item->name . ": </td>";
			if (!empty($item->description))
			{
				echo "<td class='description'>" . $item->description . "</td>"; 
				echo "<td class='price'>$" . $item->price . "</td><td>";
				echo '<button class="add_button"><a href="added.php?name=' . $item->name . '&type='. $type . '&price='. $item->price .'">Add</a></button></td></tr>';
			}
			else
			{
				echo "<td class='price'>$" . $item->price . "</td><td>";
				echo '<button class="add_button"><a href="added.php?name=' . $item->name . '&type='. $type . '&price='. $item->price .'">Add</a></button></td></tr>';
			}
		};
		echo "</table>";
	};

	function iterate_multiple_size($type)
	{
		//Iterate over items in XML and echo out in HTML list

		$xml = simplexml_load_file("menu.xml");
		//$items = $xml->xpath("category/$item"); saved as variable
		foreach($xml->xpath("category/$type") as $item)
		{
			echo "<table id='menu'>";
			echo "<tr><td class='name'>" . $item->name . ":</td>";
			echo "<td class='price'>Small: $" . $item->small . "</td>";
			echo '<td><button class="add_button"><a href="added.php?name=' .$item->name . '&type='. $type . '&price='. $item->small . '">Add</a></button></td>';
			echo "<td class='price'>Large: $" . $item->large . "</td><td>";
			echo '<button class="add_button"><a href="added.php?name=' .$item->name .'&type='. $type . '&price='. $item->large . '">Add</a></button></td></tr>';
	
		}; 
		echo "</table>";
	};
?>	
	
</head>
<body>
<?php include('header.html')?>
	
	<div id="image">
		<img src="images/header.jpg" title="Pizza image" alt="An image of pizzas being cooked"/>
	</div> <!--end of image div-->
	<div class="menu_holder">
			<h3 id='menu_title'>Menu</h3>
		<div id="accordion">
				<h3>Pizzas</h3>
					<ul>
						<?php iterate_multiple_size("pizza");?>
					</ul>
				<h3>Wraps</h3>
					<ul>
						<?php iterate_single_size("wrap");?>
					</ul>		
				<h3>Spaghetti</h3>
								<ul>
						<?php iterate_single_size("spaghetti");?>
					</ul>	
				<h3>Salads</h3>
					<ul>
						<?php iterate_multiple_size("salad");?>
					</ul>				
				<h3>Grinders</h3>
					<ul>
						<?php iterate_multiple_size("grinder");?>
					</ul>				
				<h3>Calzones</h3>
					<ul>
						<?php iterate_single_size("calzone");?>
					</ul>				

		</div> <!-- end of accordion div -->
	</div> <!-- end of menu holder div -->
	
	<div id="footer">	
	
	<p>&copy; Three Aces: 1613 Massachusetts Ave, Cambridge, MA 02139, Btwn Mellen &amp; Everett St</p>
	
	</div> <!-- end of footer -->
	
  <script type="text/javascript"> // Accordion divs script for menu
 
	  // animate the accordion
	  $(document).ready(function(){
		$("#accordion").accordion({
		active: false, collapsible: true
		});
	  });
	  
	  //makes smoother transition
	    $(function() {
    $( "#accordion" ).accordion({
      heightStyle: "content"
    });
  });

  </script>
</body>
</html>