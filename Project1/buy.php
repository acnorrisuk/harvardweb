<?php session_start();

# Redirect if not logged in.
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }



#useful variables
$symbol = $_POST['symbol'];
$buy = $_POST['buy'];
$afford = $_POST['afford'];
$price = $_POST['price'];
$balance = $_SESSION['balance'];
$new_balance = $balance - ($buy * $price);
$id = $_SESSION['user_id'];


# if user has enough money then
if($buy <= $afford)
{
	# Open database connection.
	require ( '..\connect_project1.php' ) ;

	# update balance in users table
	$query = "UPDATE users SET balance = '$new_balance' WHERE user_id = '$id'";
	$result = mysqli_query($dbc, $query);

	# update information in portfolio table
	$query = "INSERT INTO portfolio (user_id, symbol, quantity, transaction, price, time)
			  VALUES ('$id', '$symbol', '$buy', 'bought', '$price', NOW())";
		
	$result = mysqli_query($dbc, $query);
	
	$_SESSION['balance'] = $new_balance;
	# close database connection
	mysqli_close($dbc);
}
else
{
	echo "You do not have enough money to buy $buy shares";
}

header('Location: portfolio.php');
