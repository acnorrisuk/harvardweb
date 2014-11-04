
  <?php
  
if($_POST) {
  require('../connect_project1.php');
  $un = mysqli_real_escape_string($dbc, trim($_POST['username']));
  
	
  	$query = "SELECT username FROM users WHERE username='$un'";
	$result = mysqli_query($dbc, $query);
	if(mysqli_num_rows($result) != 0)
		{
			$output = false);
		}
	else{
		$output = true;}
	
mysqli_close($dbc);
	}
  echo json_encode($output);
  
  