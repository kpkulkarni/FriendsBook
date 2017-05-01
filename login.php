<?php
require_once 'dblogin.php'; //This file is required for the admin rights to connect to database. 

$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if($connection->connect_error) die($connection->connect_error);

	if(isset($_POST['username']) && isset($_POST['password']))	//Checking if values in the form are filled by user. 
	{
		$temp_username = $_POST['username'];
		$temp_password = $_POST['password'];
		
		$query = "SELECT * FROM user WHERE username = '$temp_username' AND password = '$temp_password'";
		$result = $connection->query($query);
		
		if($result->num_rows)
		{
			$row = $result->fetch_array(MYSQLI_ASSOC);
			session_start();
			$_SESSION['username'] = $temp_username;
			$_SESSION['password'] = $temp_password;
			$_SESSION['userID'] = $row['userID'];
			$_SESSION['firstname'] = $row['firstname'];
			$_SESSION['lastname'] = $row['lastname'];
			echo "Login Success.";
			echo "<br><a href='profile.php'> Click here to Continue .....</a>";
		}
		
	}
	
	else echo "Please enter username and password. <a href='index.html'>Click here to go back</a>";

?>