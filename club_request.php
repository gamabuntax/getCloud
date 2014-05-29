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
		$valid_val = array(false,false);
		if (isset($_FILES['file'])) {
			$allowed = array('image/jpeg', 'image/JPG', 'image/jpg');
			if (in_array($_FILES['file']['type'], $allowed)) {
				$valid_val[0] = true;
			}
			else {
				$valid_val[0] = false;
				echo '<button type="button" class="btn btn-danger center-block">Please upload a jpg file!</button>';
			}
		}

		else {
			$valid_val[0] = false;
			echo '<button type="button" class="btn btn-danger center-block">Please select your file</button>';
			//exit;
		}

		if (!empty($_POST['name']) && !empty($_POST['description'])) {
			$subject = "Club request for " . trim($_POST['name']);
			$message =  "Club name: " . trim($_POST['name']) . " Description: " . trim($_POST['description']);
			$clubName = trim($_POST['name']);
			$description = trim($_POST['description']);
			$valid_val[1] = true;
		}

		else {
			$valid_val[1] = false;
			echo '<button type="button" class="btn btn-danger center-block">Please enter name/description</button>';
		}

		if ($valid_val[0] == true && $valid_val[1] == true) {
			 $file = file_get_contents($_FILES['file']['tmp_name']);
			 require('./includes/mysql_connect.inc.php');
			 $escapedfile = mysqli_escape_string($link, $file);
			 $q = 'SELECT Username FROM USERS WHERE Status= "1"';
			 $result = mysqli_query($link,$q);
			 while ($admin = mysqli_fetch_array($result, MYSQLI_NUM)) {
				$q = "INSERT INTO MAILBOX (Subject, MsgTime, MsgText, Sender, Receiver,Status) VALUES ('$subject', NOW(), '$message', '$userName', '$admin[0]', '5')";
				$result_message = mysqli_query($link,$q);
			}
			$q = "INSERT INTO CLUB (ClubName, Description, Status, Username, ProfileImage) VALUES ('$clubName', '$description','1', '$userName', '$escapedfile')";
			$result = mysqli_query($link,$q);
			echo '<button type="button" class="btn btn-success center-block">Request club successfuly</button>';
			mysqli_close($link);
		}
	}
?>

<h2 class="text-center"> Club request </h2>
<form class="form-signin" role="form" action="club_request.php" method="post" enctype="multipart/form-data">

	<label> Name </label>
	<input type="text" class="form-control" name="name" placeholder="Club name"><br>
	<label> Description </label>
	<textarea name="description" cols="50" rows="4" maxlength="150" class="form-control" placeholder="Club description"></textarea><br>
	<input type="file" name="file"><br>

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