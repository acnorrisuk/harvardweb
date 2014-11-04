<html>
<head>
<title>Register</title>
<?php require('bootstrap_head.html');?>

</head><div id="container"><div id="header">
<?php

include('header.html');
echo "</div><div id='body'>";
//include('test_password.php');


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	require('../connect_project1.php');
	
	$errors = array();
	
	# first name field
	if(empty ($_POST['first_name']))
	{
		$errors[] = 'Enter your first name';
	}
	else
	{
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$fn))
		{
		  $errors[] = "Only letters and white space allowed"; 
		}
	}
	
	# last name field
	if(empty ($_POST['last_name']))
	{
		$errors[] = 'Enter your last name';
	}
	else
	{
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	    // check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$ln))
		{
			$errors[]= "Only letters and white space allowed"; 
		}
	}
	
	# email field   VALIDATE EMAIL CORRECT REGEX
	if(empty ($_POST['email']))
	{
		$errors[] = 'Enter a valid email';
	}
	else
	{
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
		// check if email address is valid
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$e)) 
		{
			$errors[] = "Invalid email format"; 
		}
	}
	
	# username field  CHECK AGAINST DATABASE!
	if(empty ($_POST['username']))
	{
		$errors[] = 'Enter a username';
	}
	else
	{
		$un = mysqli_real_escape_string($dbc, trim($_POST['username']));
	}
	
	# password field
	if(!empty ($_POST['pass1']))
	{
		if($_POST['pass1'] != $_POST['pass2'])
		{
			$errors[] = 'Passwords do not match!';
		}
		else
		{
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
			/*** example usage ***/
			//$strength = testPassword($p);
			// error suppressed from $strength variable
			if(strlen($p) < 6 || strlen($p) > 12)
			{
				$errors[] = 'Password should be between 6 and 12 characters';
			}
			
		}
	}
	else
	{
		$errors[] = 'Enter a password';
	}
	# check email and username against database
	if(empty($errors))
	{
		$query = "SELECT user_id FROM users WHERE email='$e'";
		$result = mysqli_query($dbc, $query);
		if(mysqli_num_rows($result) != 0)
		{
			$errors[] = 'Email Address already registered';
		}
	}
	
	if(empty($errors))
	{
		$query = "SELECT user_id FROM users WHERE username='$un'";
		$result = mysqli_query($dbc, $query);
		if(mysqli_num_rows($result) != 0)
		{
			$errors[] = 'Username already registered';
		}
	}
	# register user
	if(empty($errors))
	{
		$query = "INSERT INTO users
				  (first_name, last_name, email, username, password, balance, reg_date)
				  VALUES ('$fn','$ln','$e','$un',SHA1('$p'), '10000', NOW())";
		$result = mysqli_query($dbc, $query);
		
		if($result)
		{
			echo '<h1>Congratulations</h1>
				<p>You are now registered</p>';
		}
		
		mysqli_close($dbc);
		include('footer.html');
		exit();
	}
	
	else
	{
		echo '<div id="errors"><h1>Error!</h1>
			<p id="err_msg">The following error(s) occurred:<br><span>';
			foreach($errors as $msg)
			{
				echo " - $msg <br>";
			}
			echo '</span>Please try again</p>';
			echo '</div>';
			mysqli_close($dbc);
	}
	
} # end of server request condition
?>

<div id="reg-container">
<form id="customForm" action="register.php" method="POST">
	<div>
	<h2>Registration Form</h2>
	</div>
	<div>
	<label for="first_name">First Name:</label>
	<input type="text" name="first_name" id="first_name"
		value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>">
	<span id="firstnameInfo">Enter your first name</span>
	
	</div>
	<div>
	<label for="last_name">Last Name:</label>
	<input type="text" name="last_name" id="last_name"
		value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>">
	<span id="lastnameInfo">Enter your last name</span>

	</div>
	<div>
	<label for="email">Email:</label>
	<input type="text" name="email" id="email"
		value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
	<span id="emailInfo">Enter a valid email address</span>

	</div>
	<div>
	<label for="username">Username:</label>
	<input type="text" name="username" id="username" 
		value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>">
		<span id="usernameInfo">Choose a username</span>

	</div>
	<div>
	<label for="pass1">Password:</label>
	<input type="password" name="pass1" id="pass1" 
		value="<?php if(isset($_POST['pass1'])) echo $_POST['pass1'];?>">
		<span id="pass1Info">Use between 6 and 12 characters</span>
	
	</div>
	<div>
	<label for="pass2">Confirm Password:</label>
	<input type="password" name="pass2" id="pass2" 
		value="<?php if(isset($_POST['pass2'])) echo $_POST['pass2'];?>">
		<span id="pass2Info">retype your password</span>

	</div>
	<div>
	<input type="submit" value="Register" id="send" name="send">
	</div>
</form>
</div>
</div>



</div><div id="footer">
<?php 
include('footer.html');
?>
</div>
</div>