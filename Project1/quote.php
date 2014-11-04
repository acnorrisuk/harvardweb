<?php @session_start();


$symbol = urlencode(strtoupper(htmlspecialchars($_GET["symbol"])));
$url = "http://download.finance.yahoo.com/d/quotes.csv?symbol={$symbol}&f=sl1d1t1c1ohgv&e=.csv";
$handle = fopen($url, "r");
$row = fgetcsv($handle);
fclose($handle);
?> 
<html>

	<head>
		<title>Project1</title>
		<?php require('bootstrap_head.html');?>
	</head>
	
	<body>
		<div id="container">
		<div id="header">
		
		<?php 
			if (!isset($_SESSION['user_id']))
			{
				header('Location: index.php');	
			}
			else{			
				include('header2.html');
				echo "</div><div id='body'>";
			
				echo "<div id='portfolio-wrapper'>";
				
	
				# update portfolio table
				$id = $_SESSION['user_id'];
				$balance = number_format($_SESSION['balance'],2);
				
				echo "<div id='small-wrapper'>";
				echo '<h2>'. $_SESSION['username'] . '\'s ' . 'Portfolio</h2>';
				echo "<p id=\"balance\"> Current balance: $" . $balance . "</p>";
				echo "</div><hr>";?>
				
				<div id='search' class='form-group'>
				
			<div class="navbar-form" id="searchbox">
			<form action="buy.php" method="POST" class="edit" id="buy">
				<label for="buy">Buy Shares: 
				<input type="text" name="buy" id="buy" class="form-control" placeholder="Enter a number">
				<input type="hidden" name="price" value="<?php echo $row[1] ?>">
				<input type="hidden" name="symbol" value="<?php echo strtoupper(htmlspecialchars($_GET["symbol"])) ?>">
				<input type="hidden" name="afford" value="<?php echo $afford?>">
				<input type="submit" value="Buy" class="btn btn-default">
			</form>
			</div>
			<div class="navbar-form" id="searchbox">
			<form action="sell.php" method="POST" id="sell" class="edit">
				<label for="sell">Sell Shares: 
				<input type="text" name="sell" id="sell" class="form-control" placeholder="Enter a number">
				<input type="hidden" name="price" value="<?php echo $row[1] ?>">
				<input type="hidden" name="symbol" value="<?php echo strtoupper(htmlspecialchars($_GET["symbol"])) ?>">
				<input type="hidden" name="afford" value="<?php echo $afford?>">
				<input type="submit" value="Sell" class="btn btn-default">
			</form>
			</div>

		</div>

				<?php echo "<hr><br>";
				
				
			if($row[1] != 0.00)
		{
		?>
		<p><span id="span">The current price of <strong><?= strtoupper(htmlspecialchars($_GET["symbol"])) ?></strong> is <strong>$<?= $row[1] ?></strong></p>
		<p>You can afford to buy up to<strong>
		<?php
		    // how many shares could be bought of the searched stock
			$afford = floor($_SESSION['balance'] /  $row[1]);
			echo $afford . " </strong>shares of<strong> " . strtoupper(htmlspecialchars($_GET["symbol"])) . "</strong></span></p>";?>
			
		<p><span id="span">You have <strong><?php

		# Open database connection.
		require ( '..\connect_project1.php' ) ;

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
		

		# close database connection
		mysqli_close($dbc);
		if($total_shares == 1){
			echo "$total_shares </strong> share";
		}
		elseif($total_shares != 0)
		{
			echo "$total_shares</strong> shares ";
		}
		else
		{
			echo "no </strong>shares ";
		}
		?>of <strong><?= strtoupper(htmlspecialchars($_GET["symbol"])) ?></strong> to sell</p>
		
		<?php 
		echo "<a href='portfolio.php'>Back to Search</a>";
		}
		else
		{
			echo "<p><span id='span>'<strong>" .htmlspecialchars($_GET["symbol"])." </strong>is not a valid stock</span></p>";
			echo "<a href='portfolio.php'>Back to Search</a>";
		}
		
				
				echo "</div></div></div><div id='footer'";
				include('footer.html');
			}
		echo "</div>";
		include('bootstrap_body.html');?>
		
		</div> <!-- end of container -->

	</body>
	
</html>
