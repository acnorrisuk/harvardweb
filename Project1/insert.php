<?php

	// Retreive the values from the form using the HTTP method POST.
	$name = &$_POST['name'];
	$email = &$_POST['email'];
	$password = &$_POST['pass1'];
	$cpassword = &$_POST['pass2'];

	// Verifies if the variables are set
	if($name && $email && $password && $cpassword){
		// Connects to the database server MySQL
		mysql_connect("localhost", "root", "jeremy492") or die("We couldn't connect!");
		// Selects the database "testsite"
		mysql_select_db("registration_form");
		
		// Inserts the values in the selected database and table "users".
		mysql_query("INSERT INTO users(name,email,password) VALUES('$name','$email','$cpassword')");
		// outputs the "INSERTED" message.
		echo "INSERTED";
	}else{
		// outputs the "not allowed" message.
		echo "not allowed";
	}

?>