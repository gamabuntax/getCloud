<?php 
$page_title = 'getCloud | Change password';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:index.php");
}
require('./includes/sideregion.inc.php');
?>

<div id="mainregion">

<?php
	if (isset($_POST['send'])) {
		if (!empty($_POST['password']) && !empty($_POST['password_c'])) {
			$password = trim($_POST['password']);
			$password_c = trim($_POST['password_c']);

			if (strcmp($password,$password_c) == 0) {
				require('./includes/mysql_connect.inc.php');
				$q = "UPDATE USERS SET Password = MD5('$password') WHERE Username ='$userName'";
				$result = mysqli_query($link, $q);
				echo '<p class="success"> You changed your password sucessfully</p>';
			}
			else {
				echo '<p class="error">Password confirmation does not match password </p>';
			}
		}
		else {
			echo '<p class="error">Please enter your new password and password confirmation </p>';
		}
	}

?>

<h2>Change your password</h2>

<div>
<form class="form-compose" role="form" action="change_password.php" method="post">
	<label> New password </label><br>
	<input type="password" name="password" class="form-control" placeholder="New password"><br>

	<label> Password confirmation </label><br>
	<input type="password" name="password_c" class="form-control" placeholder="Password confirmation"><br>
	<input type="submit" name = "send" value="Submit" class="btn btn-default">
	<input type="reset" value="Reset"  class="btn btn-default">
</form>
</div>
<div class="clear-all"><a href="./index.php">Back to main page </a></div>

</div>


<?php
require('./includes/footer.inc.php');
?>