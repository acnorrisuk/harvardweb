<?php @session_start();?> 
<html>

	<head>
		<title>Project1</title>
		<?php require('bootstrap_head.html');
		?>
		<title>jQuery UI Autocomplete - Default functionality</title>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
	  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	  <link rel="stylesheet" href="/resources/demos/style.css">
	  
	  <script>
	  
	$(document).ready(function(){
	$("#symbol").focus();
	$("#symbol").autocomplete({
		source: function (request, response) {
			
			// faking the presence of the YAHOO library bc the callback will only work with
			// "callback=YAHOO.Finance.SymbolSuggest.ssCallback"
			var YAHOO = window.YAHOO = {Finance: {SymbolSuggest: {}}};
			
			YAHOO.Finance.SymbolSuggest.ssCallback = function (data) {
				var mapped = $.map(data.ResultSet.Result, function (e, i) {
					return {
						label: e.symbol + ' (' + e.name + ')',
						value: e.symbol
					};
				});
				response(mapped);
			};
			
			var url = [
				"http://d.yimg.com/autoc.finance.yahoo.com/autoc?",
				"query=" + request.term,
				"&callback=YAHOO.Finance.SymbolSuggest.ssCallback"];

			$.getScript(url.join(""));
		},
		minLength: 2
	});


	}); // end ready function
</script>
	  
	</head>
	
	<body>
		<div id="container">
		<div id="header">
		
		<?php 
			if (!isset($_SESSION['user_id']))
			{

				include('header.html');
				echo "</div><div id='body'>";
				echo "<div id='portfolio-wrapper'>";
				echo "<br><p><span id='span'>You need to log in to view your portfolio</span></p><br><hr>";
				echo "</div></div><div id='footer'>";
				include('footer.html');
				echo "</div></div>";
			}
			else{			
				include('header2.html');
				echo "</div><div id='body'>";
				echo "<div id='portfolio-wrapper'>";
				
				# Open database connection.
				require ( '..\connect_project1.php' ) ;
				
				# update portfolio table
				$id = $_SESSION['user_id'];
				$balance = number_format($_SESSION['balance'],2);
				$query = "SELECT * FROM portfolio WHERE user_id = '$id'";
				$result = mysqli_query($dbc, $query);
				$start_balance = number_format(10000,2);
				
				echo "<div id='small-wrapper'>";
				echo '<h2>'. $_SESSION['username'] . '\'s ' . 'Portfolio</h2>';
				echo "<p id=\"balance\"> Current balance: $" . $balance . "</p>";
				echo "</div><hr>";
				
				# search form
				echo "<div id='search' class='form-group'>";
				
		

				include('portfolio-tools.php');
				
				echo "</div>";
				echo "<hr><br>";
				
				
				if(mysqli_num_rows($result) != 0)
				{  
					echo '<div class="datagrid"><table><thead><tr><th>Stock Name</th><th>Transaction</th><th>Shares</th><th>Price</th><th>Total</th><th>Date \ Time</th></tr></thead>';
					while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
					{
						echo '<tbody><tr><td>' .
						$row['symbol'] . '</td><td>' . $row['transaction']. '</td><td>' .  $row['quantity'] . '</td><td>$' . 
						number_format($row['price'],2) . '</td><td>$' . number_format(($row['price']*$row['quantity']),2) . '</td><td>' . $row['time'] . '</td></tr>';
					}
					echo '</tbody></table></div>';
					
					mysqli_free_result($result); 
					
				} 
				else
				{
					echo "<p><span id='span'>You currently have no shares in your portfolio</span></p>";
				}

				# close database connection
				mysqli_close($dbc);
				
			
				//include ('finance.php');
				echo "</div></div>";
				

					
				
				
				echo "<div id='footer'";
				include('footer.html');
			}
		echo "</div>";
	//	include('bootstrap_body.html');
		
		

		?>
		</div> <!-- end of container -->

	</body>
	
</html>