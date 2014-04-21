<?php 
$page_title = 'getCloud | My clubs';
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

<?php
	if (isset($_POST['send'])) {
		if (!empty($_POST['name']) && !empty($_POST['description'])) {
			$subject = "Club request for " . trim($_POST['name']);
			$description =  "Club name: " . trim($_POST['name']) . " Description: " . trim($_POST['description']);
			require('./includes/mysql_connect.inc.php');

			//select admin users
			$q = 'SELECT Username FROM USERS WHERE Status= "1"';
			$result = mysqli_query($link,$q);

			while ($admin = mysqli_fetch_array($result, MYSQL_NUM)) {
				$q = "INSERT INTO MAILBOX (Subject, MsgTime, MsgText, Sender, Receiver,Status) VALUES ('$subject', NOW(), '$description', '$userName', '$admin[0]', '1')";
				$result_message = mysqli_query($link,$q);
			}

			echo '<p class="success">Success! </p>';
		}

		else {
			echo '<p class="error">Please enter a valid name and description </p>';
		}
	}

?>

<button class="btn btn-lg btn-primary" id="club_request"> Club request </button><br><br>
<div class="hideform">
<form class="form-compose" role="form" action="myclubs.php" method="post">

	<label> Name </label>
	<input type="text" class="form-control" name="name" placeholder="Club name"><br>
	<label> Description </label>
	<textarea name="description" cols="50" rows="4" maxlength="150" class="form-control" placeholder="Club description"></textarea><br>
	<input type="submit" name = "send" value="Send" class="btn btn-default">
	<input type="reset" value="Reset"  class="btn btn-default">	
</form> 
</div>

</div>





<?php
require('./includes/footer.inc.php');
?>