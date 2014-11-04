<?php
function load($page = 'index.php')
{
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	$url = rtrim($url, '/\\');
	$url .= '/' . $page;
	header("Location: $url");
	exit();
}


function validate($dbc, $username = "", $password = "")
{
	$errors = array();
	if(empty($username))
	{
		$errors[] = "enter your username";
	}
	else
	{
		$u = mysqli_real_escape_string($dbc, trim($username));
	}
	
	
	if(empty($password))
	{
		$errors[] = "enter your password";
	}
	else
	{
		$p = mysqli_real_escape_string($dbc, trim($password));
	}
	
	if(empty($errors))
	{
		$query = "SELECT user_id, username, password, balance FROM users
				  WHERE username='$u' AND password=SHA1('$p')";
				  
	    $result = mysqli_query($dbc, $query);
		
		if(mysqli_num_rows($result) == 1)
		{
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			return array(true, $row);
			echo "true";
		}
		else
		{
			$errors[] = "Username or Password not valid";
		}
	}
	return array(false, $errors);
}



