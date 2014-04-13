<?php 
$page_title = 'getCloud | index';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

require('./includes/sideregion.inc.php');
?>

<div id="mainregion">
<h2>Compose Message</h2>

<form class="form-compose" role="form" action="compose.php" method="post">
	<label> To </label><br>
	<input type="text" name="userID" class="form-control" placeholder="Username ID"><br>

	<label> Subject </label><br>
	<input type="text" name="subject" class="form-control" placeholder="Enter your subject here"><br>

	<label> Message </label><br>
	<textarea name="message" cols="70" rows="4" maxlength="150" class="form-control" placeholder="Enter your message here"></textarea><br>
	<input type="submit" name = "sendMessage" value="Send" class="btn btn-default">
	<input type="reset" value="Reset"  class="btn btn-default">
</form> 





</div>



<?php
require('./includes/footer.inc.php');
?>