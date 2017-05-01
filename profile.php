

<!DOCTYPE html>
<html>
	<head>
		<title>Friendbook Social Network</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<?php
			require_once "dblogin.php";
			$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
			if($connection->connect_error) die ($connection->connect_error);

			session_start();
		?>
	</head>
	<body>
	
	<div class="navigation">
		<h1>FriendsBook </h1>
		<div class="links">
		<ul>
			<li><a href="editprofile.php">Your Profile</a></li>
			<li><a href="Friends">Find Friends</a></li>	
			<li><a href="message">Messages</a></li>	
			<li><a href ="logout.php">Logout</a></li>
		</ul>
		</div>
	</div>
	<?php
		if(!isset($_SESSION['username']) || !isset($_SESSION['password']))
		{
			echo "<h2 class=\"welcome\">Please login first.</h2>";
		}
		elseif (isset($_SESSION['username']) && isset($_SESSION['password'])) {
			$username = $_SESSION['username'];
			$firstname = $_SESSION['firstname'];
			$lastname = $_SESSION['lastname'];
			$userID = $_SESSION['userID'];
		}
	?>
	<div class="container">
		<div class="main">
		<h2 class="welcome">Welcome <?php echo $firstname . " " . $lastname; ?></h2>
		<div>
		Post something here. 
		</div>
		<div class="postform">
			<form method="post" action="profile.php">
				<textarea id="postinput" rows="10" cols="100" name="newpost"></textarea>
				<input class="bluebutton" type="submit" value="POST">
			</form>
		<?php
	// PHP CODE For entering new post into the database from the above form.  
	if (isset($_POST['newpost'])) {
		$newpost = $_POST['newpost'];
		if($newpost != ""){
		$query = "INSERT INTO posts(userID, post) VALUES('$userID', '$newpost')"; 
		$result = $connection->query($query);
		if (!$result) echo "<p>Error Posting.</p>";
		else echo "<p>Posted successfully.</p>";
		}
		else echo "Please write something to post.";

	}

?>
		</div>

		<div class="poststream">
			<h3>Poto First name last name</h3>
			<p>Post stream will go here. Post stream will go here. Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here.Post stream will go here. </p>
			<div class="comment">
			<form method="post" action="profile.php">
				<p>comment will go here.</p>
				<input type="text" name="newcomment" size="90px" class="commentfield">
				<input class="commentbutton" type="submit" name="newpost" value="comment" >
			</form>	
			</div>

		</div>
		</div>
		
	</div>

	



	</body>
</html>



