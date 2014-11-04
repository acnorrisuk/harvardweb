<?php session_start();

# Redirect if not logged in.
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }


			
# Open database connection.
require ( '..\connect_project1.php' ) ;


#update users table
$symbol = $_POST['symbol'];
$sell = $_POST['sell'];
$price = $_POST['price'];
$balance = $_SESSION['balance'];
$new_balance = $balance + ($sell * $price);
$id = $_SESSION['user_id'];
$errors = array();

# Open database connection.
require ( '..\connect_project1.php' ) ;

# query database to check if user has enough stock to sell
# shares bought of searched symbol
$query = "SELECT SUM(quantity) AS sum FROM portfolio WHERE user_id = '$id' AND symbol = '$symbol' AND transaction ='bought'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$shares_bought = $row['sum'];

# shares sold of searched symbol
$query = "SELECT SUM(quantity) AS sum FROM portfolio WHERE user_id = '$id' AND symbol = '$symbol' AND transaction ='sold'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$shares_sold = $row['sum'];

# shares bought - shares sold
$total_shares = $shares_bought - $shares_sold;	

//echo "shares bought of $symbol : $shares_bought <br>";
//echo "shares sold of $symbol : $shares_sold <br>";
//echo "total shares : $total_shares <br>";


#IF USER HAS STOCK THEN
if($total_shares != 0)
{

	#IF USER HAS ENOUGH STOCK THEN
	if($total_shares >= $sell)
	{

	# update users table
	$query = "UPDATE users SET balance = '$new_balance' WHERE user_id = '$id'";
	$_SESSION['balance'] = $new_balance;

	$result = mysqli_query($dbc, $query);


	# update portfolio table
	$query = "INSERT INTO portfolio (user_id, symbol, quantity, transaction, price, time)
			  VALUES ('$id', '$symbol', '$sell', 'sold', '$price', NOW())";
		
	$result = mysqli_query($dbc, $query);

	# close database connection
	mysqli_close($dbc);
	
	header('Location: portfolio.php');

	} # end of check user stock
	
	else
	{
		echo "You do not have enough shares of $symbol to sell";
		header('Location: portfolio.php');
	}
}
else
{
		echo "You do not own any shares of $symbol";
		header('Location: portfolio.php');


}

				


//header('Location: portfolio.php');

