<?php session_start();

function clear()
{
	session_destroy();
	session_start();
}

clear();

header( 'Location: cart.php' ) ;
?>