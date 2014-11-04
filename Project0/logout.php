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
<div id='logout_holder'>

<?php
session_destroy();

echo "<p>Thank you for shopping with Three Aces! <br/>Your session data has been reset.<br/></p>";
echo "<button class='add_button2'><a href='index.php'>Menu</a><br/></button>";

?>
</div> <!-- end of logout holder-->
</div> <!-- end of menu holder -->
<div id="footer">	
	
	<p>&copy; Three Aces: 1613 Massachusetts Ave, Cambridge, MA 02139, Btwn Mellen &amp; Everett St</p>
	
	</div> <!-- end of footer -->
</body>
</html>