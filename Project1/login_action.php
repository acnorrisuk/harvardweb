<?php



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// establish a database connection
	require('../connect_project1.php');

	
	// process login
	require('login_tools.php');
	
	  # Check login.
		list ( $check, $data ) = validate ( $dbc, ucfirst($_POST[ 'username' ]), $_POST[ 'password' ] ) ;

		if ( $check )  
	{
    # Access session.
		session_start();
		
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['balance'] = $data['balance'];
		
		// load function defined in login_tools.php
		load('portfolio.php');
	}
		else
		{
			$errors[] = "Username or Password not valid";
		}
	}
	header('Location: index.php');
  # Close database connection.
  mysqli_close( $dbc ) ; 

