<?php 
$page_title = 'getCloud | Clubs';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

require('./includes/view_club_tab.inc.php');
?>

<h1> Member Request </h1>
	 <table class="table table-striped table-condensed table-hover row-clickable">
            <tr class="message-header">
                <td width="10%">
                    <strong>Username</strong>
                </td>
                <td width="10%">
                    <strong>Action</strong>
                </td>

            </tr>
<?php
	require('./includes/mysql_connect.inc.php');
	$q = "SELECT Username  FROM MEMBER WHERE ClubID = '$clubID' and Status= 2";
	$result = mysqli_query($link,$q);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
			echo '<tr>
            <td width="10%">' . $row[0] . '</td>
            <td width="10%"><form action="moderator.php" method="post">
                    <input type="hidden" name="requestName"  value="'.$row[0].'">
                     <input type="hidden" name="ClubID"  value="'.$clubID.'">		
                    <button type="submit" name="accept" class="btn btn-default">Ok</button></form></td>
            </tr>';	
		}
	}

	if (isset($_POST['accept'])) {
		$requestName = $_POST['requestName'];
		$q = "UPDATE MEMBER SET Status = 0 WHERE ClubID='$clubID' AND Username ='$requestName'";
		$result = mysqli_query($link,$q);
		mysqli_close($link);
		header("Location:moderator.php?ClubID=" . $_POST['ClubID']);
	}
	mysqli_close($link);
?>

</table>

<h1> Member </h1>
	 <table class="table table-striped table-condensed table-hover row-clickable">
            <tr class="message-header">
                <td width="10%">
                    <strong>Username</strong>
                </td>
                <td width="10%">
                    <strong>Status</strong>
                </td>

                <td width="10%">
                    <strong>Action</strong>
                </td>

            </tr>

<?php

	require('./includes/mysql_connect.inc.php');
	$q = "SELECT Username, Status  FROM MEMBER WHERE ClubID = '$clubID' and Status != 2 and Privilage = 0";
	$result = mysqli_query($link,$q);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
			if ($row[1] == 0) {
				$memberStatus = "Active";
			}
			else {
				$memberStatus = "Ban";
			}

			echo "<tr>
            <td width='10%''>" . $row[0] . "</td>
            <td width='10%''>" . $memberStatus . "</td>

            <td width='10%'><form class='form-inline' action='moderator.php' method='post'>
            <select class='form-control' name='action_mod'>
            <option value='active'>Active</option>
            <option value='ban'>Ban</option>
            <option value='remove'>Remove</option>
            </select>
            <input type='hidden' name='memberName' value='".$row[0]."'/>
            <input type='hidden' name='ClubID' value='".$clubID."''>
            <button type='submit' name ='moderator_submit' class='btn btn-default'>Submit</button>
            </form></td>
            </tr>";	
		}
	}


	if (isset($_POST['moderator_submit'])) {
		$memberName = $_POST['memberName'];
		$option = $_POST['action_mod'];

		if ($option == 'active') {
			$q = "UPDATE MEMBER SET Status = 0 WHERE ClubID='$clubID' AND Username ='$memberName'";
		}

		elseif ($option == 'ban') {
			$q = "UPDATE MEMBER SET Status = 1 WHERE ClubID='$clubID' AND Username ='$memberName'";
		}

		else {
			$q = "DELETE FROM MEMBER WHERE ClubID = '$clubID' AND Username = '$memberName'";
		}

		$result = mysqli_query($link,$q);
		mysqli_close($link);
		header("Location:moderator.php?ClubID=" . $_POST['ClubID']);
	}
	mysqli_close($link);
?>


</table>

<?php		
	if (isset($_POST['send'])) {
		if (!empty($_POST['subject']) && !empty($_POST['message'])) {
			$subject = trim($_POST['subject']);
			$message = trim($_POST['message']);
			
			require('./includes/mysql_connect.inc.php');
			
			$q = "SELECT Username  FROM MEMBER WHERE ClubID = '$clubID' and Status= 0 and Privilage=0";
			$result = mysqli_query($link,$q);

			while ($member = mysqli_fetch_array($result, MYSQL_NUM)) {
				$q = "INSERT INTO MAILBOX (Subject, MsgTime, MsgText, Sender, Receiver,Status) VALUES ('$subject', NOW(), '$message', '$userName', '$member[0]', '5')";
				$result_message = mysqli_query($link,$q);

				echo '<button type="button" class="btn btn-success"> Sucessfully end messages to all members</button>';
			}
			
			mysqli_close($link);
		}
		else {
			echo '<button type="button" class="btn btn-danger">Please enter subject/message</button>';
		} 
	}
			

?>

<div>
<h1 class="">Message to all members</h1>

<form class="form-compose" role="form" action="moderator.php" method="post">
	<label> Subject </label><br>
	<input type="text" name="subject" class="form-control" placeholder="Enter your subject here">

	<label> Message </label><br>
	<textarea name="message" cols="70" rows="4" maxlength="150" class="form-control" placeholder="Enter your message here"></textarea><br>
	<input type='hidden' name='ClubID' value= <?php echo '"'.$clubID .'"'; ?>>
	<input type="submit" name = "send" value="Send" class="btn btn-default">
	<input type="reset" value="Reset"  class="btn btn-default">
</form>
</div>
<br>
<br>


<?php
require('./includes/updateClub.inc.php');

?>


<?php
require('./includes/footer.inc.php');
?>