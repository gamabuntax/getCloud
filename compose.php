<?php 
$page_title = 'getCloud | compose';
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

<?php		
	if (isset($_POST['send'])) {
		if (!empty($_POST['userID']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
			$receiverID = trim($_POST['userID']);
			$subject = trim($_POST['subject']);
			$message = trim($_POST['message']);
			
			require('./includes/mysql_connect.inc.php');
			
			//check for valid reciever username
			$q = "SELECT Username FROM USERS WHERE Username ='$receiverID'";
			//run the query
			$result = mysqli_query($link,$q);
			if (mysqli_num_rows($result) == 1) {
				///////send message////////
				$q = "INSERT INTO MAILBOX (Subject, MsgTime, MsgText, Sender, Receiver,Status) VALUES ('$subject', NOW(), '$message', '$userName', '$receiverID', '1')";
				$result = mysqli_query($link,$q);
			
				//sleep(3);//seconds to wait..
				
				//header("Location:inbox.php");
				echo '<p class="success">Message has been sent succesfully!</p>';
			}
			else {
				echo '<p class="error">Please enter a valid username.</p>';
			} 
		
		mysqli_close($link);
		}
		else {
			echo '<p class="error">Please enter a valid name, username, and password. </p>';		
		}
		
	}
?>

<div>
<form class="form-compose" role="form" action="compose.php" method="post">
	<label> To </label><br>
	<input type="text" name="userID" class="form-control" placeholder="Username ID"><br>

	<label> Subject </label><br>
	<input type="text" name="subject" class="form-control" placeholder="Enter your subject here"><br>

	<label> Message </label><br>
	<textarea name="message" cols="70" rows="4" maxlength="150" class="form-control" placeholder="Enter your message here"></textarea><br>
	<input type="submit" name = "send" value="Send" class="btn btn-default">
	<input type="reset" value="Reset"  class="btn btn-default">
</form>

</div>

<div class="clear-all"> <br>
<br><br>
<a  href="./index.php">Back to main page </a></div>
</div>


<?php
require('./includes/footer.inc.php');
?>