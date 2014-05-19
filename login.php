<?php 
$page_title = 'Log in';
require('./includes/header.inc.php');
?>

<?php

if (isset($_SESSION['userName'])) {
	header("Location:inbox.php");
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//minimum form validation
	if (!empty($_POST['username']) && !empty($_POST['password'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		require('./includes/mysql_connect.inc.php');
		
	    //retrieve username
		$q = "SELECT Username FROM USERS WHERE Username ='$username' AND Password = MD5('$password')";
		
		//run the query
		$result = pg_query($link,$q);
		if (pg_num_rows($result) == 1) {
			$_SESSION['userName'] = $username;

			if ($username == "admin") {
				$_SESSION['userType'] = "admin";
			}
			else {
				$_SESSION['userType'] = "user";
			}	
			
			pg_close($link);
			header("Location:inbox.php");
		}
		else {
			echo '<button type="button" class="btn btn-danger center-block">Invalid username/password combination </button>';
		}
		pg_close($link);
	}
	
	else {
		echo '<button type="button" class="btn btn-danger center-block">Please enter your username and password </button>';

	}
}
?>

<form class="form-signin" role="form" action="login.php" method="post">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="text" class="form-control" name="username" placeholder="Username">
        <input type="password" class="form-control" name = "password" placeholder="Password">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form> <br>
      <p class="text-center">Dont have an account? <a href = "./register.php">Register here</a></p>

<?php
require('./includes/footer.inc.php');
?>
