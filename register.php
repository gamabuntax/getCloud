<?php 
$page_title = 'Register';
require('./includes/header.inc.php');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	
	//minimum form validation
	if (!empty($_POST['fullname']) && !empty($_POST['username']) && !empty($_POST['password'])) {
		$fullname = trim($_POST['fullname']);
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);
		
		//connect to the db
		require('./includes/mysql_connect.inc.php');
	    
        //makeing the query
        $q = "INSERT INTO USERS(FullName, Username, Password) VALUES('$fullname','$username', MD5('$password'))";
        
        $result = mysqli_query($link, $q);
        if ($result) {
			echo '<p class = "error"> Register successfully!!</p>';
		}
		
		else {
			echo '<p class = "error"> Username is already taken!</p>';
		}
        mysqli_close($link);		
	} 
	
	else {
		echo '<p class="error">Please enter a vaid name, username, and password! </p>';
	} 
}
?>

<form class="form-signin" role="form" action="register.php" method="post">
        <h2 class="form-signin-heading">Please register</h2>
        <label> Name </label> <br>
        <input type="text" class="form-control" name="fullname" placeholder="Full name">
        <label> Username </label><br>
		<input type="text" class="form-control" name="username"  placeholder="Username">

		<label> Password </label><br>
        <input type="password" class="form-control" name = "password" placeholder="Password">
		<label> Password confirmation </label><br>
        <input type="password" class="form-control" name = "password_c" placeholder="Password confirmation">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
      </form> <br>
      <p class="text-center">Already have an account? <a href = "./login.php">Sign in here</a></p>

<?php
require('./includes/footer.inc.php');
?>