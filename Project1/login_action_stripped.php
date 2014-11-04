<?php



if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// establish a database connection
	require('../connect_project1.php');
	
	
	// get associated user details
	$username=isset($_POST['username']) ? $_POST['username'] : $_GET['username'];
	$password=isset($_POST['password']) ? $_POST['password'] : $_GET['password'];


/*
$username="007";
$password="secret";

	$user=isset($_POST['username']) ? $_POST['username'] : $_GET['username'];
	$pass=isset($_POST['password']) ? $_POST['password'] : $_GET['password'];

if ($user==$username && $pass==$password) {
  echo 'pass';
} else {
  echo 'fail';
}
*/


		$query = "SELECT user_id, username, password, balance FROM users
				  WHERE username='$username' AND password=SHA1('$password')";
				  
	    $result = mysqli_query($dbc, $query);
		
		
		if(mysqli_num_rows($result) == 1)
		{
			//$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
//			return array(true, $row);

		echo "pass";
		
		}
		else
		{
			//$errors[] = "Username or Password not valid";
			echo "fail";
		}
	
	//list($check, $data) = validate($dbc, $username, $password);
	
	// set user details as sessions or assign error messages

	mysqli_close($dbc);
}
