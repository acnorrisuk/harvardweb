<?php 

# Access session.
session_start() ; ?>

<html>
<head>
		<?php require('bootstrap_head.html');?>
		<?php include('bootstrap_body.html');?>
</head>
<body>

<?php

# Redirect if not logged in.
//if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'logout' ;
echo "<div id='container'><div id='header'>";
include ( 'header.html' ) ;
echo "</div><div id='body'>";
echo "<div id='portfolio-wrapper'>";


# Clear existing variables.
$_SESSION = array() ;
  
# Destroy the session.
session_destroy() ;

# Display body section.
echo '<h1>Goodbye!</h1><p>You are now logged out.</p>' ;
echo "<a href='index.php'>Back to Homepage</a>";
echo "<br><hr></div></div>";
echo "<div id='footer'>";

# Display footer section.
include ( 'footer.html' ) ;
echo "</div></div>";


?>
<body>
</html>