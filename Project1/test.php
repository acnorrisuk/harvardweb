<?php
# Open database connection.
require ( '..\connect_project1.php' ) ;

# query database to check if user has enough stock to sell
$query = "SELECT SUM(quantity) AS sum FROM portfolio WHERE user_id = 1 AND symbol = 'GOOG'";
$result = mysqli_query($dbc, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
echo $row['sum'];




#IF USER HAS STOCK THEN

#IF USER HAS ENOUGH STOCK THEN


	
$result = mysqli_query($dbc, $query);

# close database connection
mysqli_close($dbc);