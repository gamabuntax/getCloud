<?php 
$page_title = 'getCloud | Change password';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:index.php");
}
?>



<?php
	if (isset($_POST['send'])) {
		if (!empty($_POST['password']) && !empty($_POST['password_c'])) {
			$password = trim($_POST['password']);
			$password_c = trim($_POST['password_c']);

			if (strcmp($password,$password_c) == 0) {
				require('./includes/mysql_connect.inc.php');
				$q = "UPDATE USERS SET Password = MD5('$password') WHERE Username ='$userName'";
				$result = mysqli_query($link, $q);
				echo '<button type="button" class="btn btn-success center-block">You changed your password sucessfully</button>';
			}
			else {
				echo '<button type="button" class="btn btn-danger center-block">Password confirmation does not match password </button>';
			}
		}
		else {
			echo '<button type="button" class="btn btn-danger center-block">Please enter your new password and password confirmation </button>';
			
		}
	}

?>

<h1 class ="text-center">Change your password</h1>

<div>
<form class="form-signin" role="form" action="change_password.php" method="post">
	<label> New password </label><br>
	<input type="password" name="password" class="form-control" placeholder="New password">

	<label> Password confirmation </label><br>
	<input type="password" name="password_c" class="form-control" placeholder="Password confirmation"><br>
	<input type="submit" name = "send" value="Submit" class="btn btn-default">
	<input type="reset" value="Reset"  class="btn btn-default">
</form>
</div>
<div class="clear-all"><br><br><p class="text-center"><a href="./index.php">Back to main </a></p></div>



<?php
require('./includes/footer.inc.php');
?>