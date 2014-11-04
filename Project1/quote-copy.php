<?php @session_start();

$symbol = urlencode($_GET['symbol']);
$url = "http://download.finance.yahoo.com/d/quotes.csv?symbol={$symbol}&f=sl1d1t1c1ohgv&e=.csv";
$handle = fopen($url, "r");
$row = fgetcsv($handle);
fclose($handle);

?>

 <!DOCTYPE html>

<html>
	<head>
		<title>Project1</title>
		<?php require('bootstrap_head.html');?>
	</head>
	<body>
		<div id="container">
		<div id="header">
		<?php 
		$balance = number_format($_SESSION['balance'],2);
		include('header.html');
		echo "</div><div id='body'>";
		
		echo "<div id='small-wrapper'>";
		echo '<h2>'. $_SESSION['username'] . '\'s ' . 'Portfolio</h2>';
		echo "<p id=\"balance\"> Current balance: $" . $balance . "</p>";
		echo "</div><hr>";
		
		if($row[1] != 0.00)
		{
		?>
		<p>The current price of <?= htmlspecialchars($_GET["symbol"]) ?> is $<?= $row[1] ?></p>
		<p>You can afford to buy up to 
		<?php
		    // how many shares could be bought of the searched stock
			$afford = floor($_SESSION['balance'] /  $row[1]);
			echo $afford . " shares of " . $_GET['symbol'] . "</p>";
		}
		else
		{
			echo "<p>" .htmlspecialchars($_GET["symbol"])." is not a valid stock</p>";
		}
		?>
		<div id='search' class='form-group'>
				
		<div id='form-wrapper' class="form-group navbar-form">
			<form action="buy.php" method="POST" class="edit">
				<label for="buy">Buy Shares: 
				<input type="text" name="buy" id="buy" class="form-control" placeholder="e.g. GOOG">
				<input type="hidden" name="price" value="<?php echo $row[1] ?>">
				<input type="hidden" name="symbol" value="<?php echo $_GET['symbol'] ?>">
				<input type="hidden" name="afford" value="<?php echo $afford?>">
				<input type="submit" value="Buy" class="btn btn-default">
			</form>
			<form action="sell.php" method="POST">
				<label for="sell">Sell Shares: 
				<input type="text" name="sell" id="sell" class="form-control" placeholder="e.g. GOOG">
				<input type="hidden" name="price" value="<?php echo $row[1] ?>">
				<input type="hidden" name="symbol" value="<?php echo $_GET['symbol'] ?>">
				<input type="hidden" name="afford" value="<?php echo $afford?>">
				<input type="submit" value="Sell" class="btn btn-default">
			</form>
		</div>
		</div>
		<hr><br>
		</div><div id="footer">
		<?php 
		include('bootstrap_body.html');
		include('footer.html');
		?>
		</div>
	</body>
</html>