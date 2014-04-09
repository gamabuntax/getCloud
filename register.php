<?php 
$page_title = 'Register';
require('./includes/header.inc.php');
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
      </form>

<?php
include ('./includes/footer.inc.php');
?>