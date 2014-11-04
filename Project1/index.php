<?php @session_start() ?>
<!DOCTYPE html>

<html>

	<head>
		<title>Home</title>
		<?php require('bootstrap_head.html');?>
		<?php include('bootstrap_body.html');?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>

	<Script>
		$(document).ready(function(){
				$(".show-more a").on("click", function() {
			var $link = $(this);
			var $content = $link.parent().prev("div.text-content");
			var linkText = $link.text().toUpperCase();
			 
			$content.toggleClass("short-text, full-text");
		 
			$link.text(getShowLinkText(linkText));
			 
			return false;
		});
		 
		function getShowLinkText(currentText){
			var newText = '';
			 
			if (currentText === "Read More") {
				newText = "Show Less";
			} else {
				newText = "Show Less";
			}
			 
			return newText;
		}
		
		}); // end document ready
	</script>
	</head>
	
	<body>
	
	
		<div id="container">
		<div id="header">
		<?php 
		if (!isset($_SESSION['user_id']))
			{

			include('header.html');
			}
			else{
				include('header2.html');
			}
		?>
		</div>
		<div id="body">
	

			<div class="panel-body">
			
			
				
				<div class="media">
					<a class="pull-left" href="#">
						<img class="media-object img-circle" src="images/finance.jpg" alt="Small Image">
					</a>
					<div class="media-body text-container">
						<h4 class="media-heading">How to get started</h4>
						<div class="text-content short-text">
						<p>Buying and selling shares is easier now thanks to low-cost internet dealing and the ability to track your portfolio online. However, it still requires some preparation and thought.
						First you need to set your investment goals – whether they're to generate income or capital growth. Shares that pay a generous dividend tend to deliver income, while fast-growing new companies could generate capital growth. It depends on what you want to achieve.
						Next, consider your appetite for risk. How comfortable are you taking risks? You can lose all of your money investing on the stock market. If you dislike taking any chances with your money, the stock market may not be for you.
						Higher returns are typically associated with higher risk shares and lower returns with lower risk shares. So-called 'blue chip' shares – those in FTSE 100 companies – tend to move up and down less than faster-growing, riskier companies' shares, which could therefore generate higher returns. Investors may aim to create a well-rounded, diversified share portfolio that balances higher-risk investments with lower-risk ones.
						</p>
						</div>
						<div class="show-more">
						<a href="#">Show more</a>
						</div>
					</div>
				</div>
				
				
				<div class="media">
					<a class="pull-left" href="#">
						<img class="media-object img-circle" src="images/finance2.jpg" alt="Small Image">
					</a>
					<div class="media-body text-container">
						<h4 class="media-heading">Buying and selling shares</h4>
						<div class="text-content short-text">
						<p>Invest through a stockbroker: If you’re looking to invest in a company’s stocks and shares, you need to do this through a broker such as Barclays Stockbrokers (Link opens in a new window)
					Invest in stocks and shares through a fund: Rather than following the markets and picking shares or bonds yourself, you could invest in a fund from Barclays Stockbrokers Funds Market. Funds invest in a mix of assets including individual stocks and shares, helping you diversify your investment portfolio
					As a general rule, holding one investment can be riskier than holding 2. And 3 can be safer than 2. 4 can be better than 3 and so on. This is because all investments do not react in the same way to the same economic or trading conditions
					Barclays Stockbrokers offers a broad range of funds so you can start building your own investment portfolio
					With Barclays Stockbrokers, you can invest in shares through an Investment ISA up to a maximum of £11,520 in the current tax year.</p>
						</div>
						<div class="show-more">
						<a href="#">Show more</a>
						</div>
					</div>
				</div>
					
				<div class="media">
					<a class="pull-left" href="#">
						<img class="media-object img-circle" src="images/finance3.gif" alt="Small Image">
					</a>
					<div class="media-body text-container">
						<h4 class="media-heading">Do your homework</h4>
						<div class="text-content short-text">
						<p>Always do your own research. Never buy shares on a friend’s advice or even because of a newspaper recommendation. Make your own decisions. Take your time and don’t rush. It can be tempting to trade regularly but you are more likely to lose money doing so. Don’t forget you will have to pay commission fees each time you buy or sell shares
					Share prices will fall as well as rise so think of the bigger picture. Be prepared to invest for the medium to long term (usually 5 to 10 years) and expect your investments to fluctuate during that time
					Remember that if the company's share price drops below what you originally paid the value of your original investment will fall. Never invest money you need for other purposes, such as paying your bills</p>
					</div>
						<div class="show-more">
						<a href="#">Show more</a>
						</div>
					</div>
				</div>
					
			</div>
		
		<div id="rss">
			<?php include('rss.html');?>
		</div></div><!--end body--><div id="footer">
		<?php include('footer.html');?></div>
		</div> <!--end container-->


	</body>

</html>


