<?php 
$page_title = 'getCloud | Club request';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

?>


<?php
require('./includes/club_tab.inc.php');
?>

<?php
	if (isset($_POST['send'])) {
		if (!empty($_POST['name']) && !empty($_POST['description'])) {
			$subject = "Club request for " . trim($_POST['name']);
			$message =  "Club name: " . trim($_POST['name']) . " Description: " . trim($_POST['description']);
			$clubName = trim($_POST['name']);
			$description = trim($_POST['description']);
			require('./includes/mysql_connect.inc.php');

			//select admin users
			$q = 'SELECT Username FROM USERS WHERE Status= "1"';
			$result = mysqli_query($link,$q);

			while ($admin = mysqli_fetch_array($result, MYSQL_NUM)) {
				$q = "INSERT INTO MAILBOX (Subject, MsgTime, MsgText, Sender, Receiver,Status) VALUES ('$subject', NOW(), '$message', '$userName', '$admin[0]', '5')";
				$result_message = mysqli_query($link,$q);
			}

			$q = "INSERT INTO CLUB (ClubName, Description, Status, Username) VALUES ('$clubName', '$description','1', '$userName')";
			$result = mysqli_query($link,$q);

			echo '<button type="button" class="btn btn-success center-block">Your request has been sent! </button>';	
			mysqli_close($link);
		}
		else {
			echo '<button type="button" class="btn btn-danger center-block">Please enter club name and description </button>';	
		}
	}
?>

<h2 class="text-center"> Club request </h2>
<form class="form-signin" role="form" action="club_request.php" method="post">

	<label> Name </label>
	<input type="text" class="form-control" name="name" placeholder="Club name"><br>
	<label> Description </label>
	<textarea name="description" cols="50" rows="4" maxlength="150" class="form-control" placeholder="Club description"></textarea><br>
	<input type="submit" name = "send" value="Send" class="btn btn-default">
	<input type="reset" value="Reset"  class="btn btn-default">	
</form> 

<div class="clear-all">
<br><br>
<p class="text-center"><a  href="./myclubs.php">Back to my clubs</a></div></p>
</div>

<?php
require('./includes/footer.inc.php');
?>