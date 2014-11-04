<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
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
</head>
<body>
<?php include('header.html')?>
	
	<div id="image">
		<img src="images/header.jpg" title="Pizza image" alt="An image of pizzas being cooked"/>
	</div> <!--end of image div-->
	
<div class="menu_holder">
<div id="cart_holder">
<?php
$page_title = 'Cart';

$total = 0;

if(!empty($_SESSION['cart']))
{
	//print_r(array_values($_SESSION['cart']));              // recursive print to check items in array
	
	
	// The shopping cart
	
	echo "<h3>Cart</h3><form action='clear.php' method='POST'>";
	echo "<table id='cart'><tr><th>Item</th><th>Type</th><th>Quantity</th><th>Price</th>";
	
	// calculate totals
	foreach($_SESSION['cart'] as $result)
	{
		$total += $result['price'] * $result['quantity'];
		$total_format = number_format($total,2);
	}
	
	// echo out cart results as a table
	//$result['quantity'];
	//<input type='text' size='3' name='qty' value=" . $result['quantity'] .
	foreach($_SESSION['cart'] as $result)
	{
		echo "<tr><td>" . $result['name'] ."</td>";
		echo "<td>" . $result['type'] ."</td>";
		echo "<td>" . $result['quantity'] . 
			 "</td><td>" . $result['price'] . "</td></tr>";
	}
	echo "<tr><td>Total: </td><td></td><td></td><td id='total'>" . $total_format . "</td>
		  </table><br/>"; ?>

		  
<?php echo "<input type='submit' value='Clear Cart' id='clear_cart'></form><br/>";
}
else
{
	echo '<p style="margin-top: 100px;">Your cart is currently empty!</p>';
}

echo "<button class='add_button2'><a href='index.php'>Menu</a><br/></button>";
echo "<button class='add_button2'><a href='checkout.php?total=" . $total_format . "'>Checkout</a><br/></button>";
echo "<button class='add_button2'><a href='logout.php'>Logout</a><br/></button>";

?>
</div> <!--end of cart holder-->
</div><!--end of menu holder-->
<div id="footer">	
	
	<p>&copy; Three Aces: 1613 Massachusetts Ave, Cambridge, MA 02139, Btwn Mellen &amp; Everett St</p>
	
	</div> <!-- end of footer -->
</body>
</html>
