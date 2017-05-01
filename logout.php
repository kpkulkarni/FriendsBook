<!DOCTYPE html>
<html>
	<head>
		<title>Friendbook Social Network</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
			// require_once "dblogin.php";
			// $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
			// if($connection->connect_error) die ($connection->connect_error);

			session_start();
		?>
	</head>
	<body>
	
	<div class="navigation">
		<h1>FriendsBook </h1>
<!-- 		<div class="links">
		<ul>
			<li><a href="editprofile.php">Your Profile</a></li>
			<li><a href="Friends">Find Friends</a></li>	
			<li><a href="message">Messages</a></li>	
			<li><a href ="lagout.php">Logout</a></li>
		</ul>
		</div>
 -->	</div>
	<?php
			$_SESSION = array();
		// setcoockie(session_name(), ' ', time(), -2592000, '/');
		session_destroy();

	?>
	<div class="container">
		<div class="main">
	
		
	<?php	echo "You logged out successfully.";
		echo "<a href='index.php'>Click here to Login Again.</a>";
		?>

		
		</div>
		</div>
	</body>
	</html>



