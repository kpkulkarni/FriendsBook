
<!DOCTYPE html>
<html>
	<head>
		<title>Friendbook Social Network</title>
		<link rel="Stylesheet" href="styles.css">
	</head>
	<body>
		
	<?php

require_once 'dblogin.php';
session_start();
$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if($connection->connect_error) die($connection->connect_error);

// echo "<a href='profile.php' class=\"navigation\">Go Back to posts. </a>";

	if(isset($_SESSION['username']) && isset($_SESSION['password']))
	{
		$username = $_SESSION['username'];
		$password = $_SESSION['password'];
		$firstname = $_SESSION['firstname'];
		$lastname = $_SESSION['lastname'];
		$userID = $_SESSION['userID'];

		$query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'"; 
		$result = $connection->query($query);
		
		if($result->num_rows)
		{

			$row = $result->fetch_array(MYSQLI_ASSOC);
			
			$oldfname = $row['firstname'];
			$oldlname = $row['lastname'];
			$oldemail = $row['email'];
			$oldaddress = $row['address'];
			$oldpic = $row['profilephoto'];
			echo <<<_END
			<div class="navigation">
		<h1>FriendsBook </h1>
		<div class="links">
		<ul>
			<li><a href='profile.php' class=\"navigation\">Go Back to posts</a></li>
			<li><a href="Friends">Find Friends</a></li>	
			<li><a href="message">Messages</a></li>	
			<li><a href ="logout.php">Logout</a></li>
		</ul>
		</div>
	</div>
		<div class="container main">
		<h3 >Edit Profile : </h3><br>
		<form method='post' action='editprofile.php' enctype='multipart/form-data'>
		<table>
		<tr>
		<td>First Name : </td>
		<td><input type='text' name='newname' value = '$oldfname' size = '30'></td>
		</tr>
		<tr>
		<td>Last Name : </td>
		<td><input type='text' name='newlastname' value = '$oldlname' size = '30'></td>
		</tr>
		<tr>
		<td>Email : </td>
		<td><input type='text' name='newemail' value = '$oldemail' size = '40'></td>
		</tr>
		<tr>
		<td>Address : </td>
		<td> <input type='text' name='newaddress' value = '$oldaddress' size = '40'></td>
		</tr>
		<tr>
		<td>Profile Pic :</td>
		<td><input type='file' name='filename' size='20'></td>
		</tr>
		<tr>
		<td></td><td><input type='submit' value='UPDATE PROFILE' class="bluebutton"></td>
		</tr>
		</table>
		</form>
		
		
_END;
		}
		
		echo <<<_END
	<span><img id="profileImage" src="$oldpic" width="300px" height="300px"	></span></div>
_END;

	}

	
	else echo "You are not logged in. <a href='index.html'>Please login from here.</a>";

if(isset($_POST['newname']) && isset($_POST['newlastname']) && isset($_POST['newemail']) && isset($_POST['newaddress']))
{
	$newdata = array($_POST['newname'], $_POST['newlastname'], $_POST['newemail'], $_POST['newaddress']);
	
	
	$query= "UPDATE user SET firstname='$newdata[0]', lastname='$newdata[1]', email='$newdata[2]', address='$newdata[3]' WHERE username = '$username'"; 
	
	
		if($_FILES) 
		{
			$name = $_FILES['filename']['name'];		//image name is retrieved and saved in variable
			$targetPath = "ProfileImages/"  . "profile". $name;	//path where to save file is given and saved in variable appending the file name.
			move_uploaded_file($_FILES['filename']['tmp_name'], $targetPath); 
			
			echo $targetPath;
			
			$query = "UPDATE user SET firstname='$newdata[0]', lastname='$newdata[1]', email='$newdata[2]', address='$newdata[3]', profilephoto ='$targetPath' WHERE username = '$username'";
			
		}
	$result = $connection->query($query);
	if(!$result) echo "update failed.";
	else echo "Your Profile successfully Updated.";
	
}

?>
<script type="text/javascript">
	if(document.getElementById("profileImage"))
	{
		document.getElementById("profileImage").style.border = "2px solid black"	
	}
</script>
		
	</body>
</html>


