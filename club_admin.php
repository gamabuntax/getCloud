<?php 
$page_title = 'getCloud | index';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}
?>

<h1> Club Request </h1>
	 <table class="table table-striped table-condensed table-hover row-clickable" width="100%">
            <tr class="message-header">
                <td  width="10%">
                    <strong>Image </strong>
                </td>
                <td width="10%">
                    <strong>User </strong>
                </td>
                <td width="20%">
                    <strong>Club name</strong>
                </td>
                <td width="40%">
                    <strong>Description</strong>
                </td>
                <td width="5%">
                    <strong>Action</strong>
                </td>
                  <td width="5%">
                    <strong></strong>
                </td>
            </tr>

<?php
	require('./includes/mysql_connect.inc.php');
	$q = "SELECT Username, ClubName, Description, ClubID, ProfileImage FROM CLUB WHERE Status=1";
	$result = mysqli_query($link,$q);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
            $file = base64_encode($row[4]);
			echo '<tr>

                <td width="10%"><img src="data:image;base64,'.$file.'" height="50" width=""></td>

				<td width="10%">'. $row[0] . '</td><td width ="20%">' . $row[1] . '</td><td width="40%">' . $row[2] . '</td>

				 <td width="5%"><form action="club_admin.php" method="post">
                    <input type="hidden" name="id"  value="'.$row[3].'">
                    <input type="hidden" name="requestName"  value="'.$row[0].'">	
                    <button type="submit" name="accept" class="btn btn-xs"><img src="./includes/accept.jpg" /></button></form></td>

                  <td width="5%"><form action="club_admin.php" method="post">
                    <input type="hidden" name="id"  value="'.$row[3].'">
                    <input type="hidden" name="requestName"  value="'.$row[0].'">
                    <input type="hidden" name="requestTitle"  value="'.$row[1].'">
                    <button type="submit" name="decline" class="btn btn-xs"><img src="./includes/delete.png" /></button></form>
                    </td></tr>';			
		}
	}

	if(isset($_POST['accept'])){
		$id = $_POST['id'];
		$receiver = $_POST['requestName'];
		$query = "UPDATE CLUB SET Status = 2 WHERE ClubID = '$id'";
    	mysqli_query($link, $query);
    	$query = "INSERT INTO MEMBER (Username, ClubID, Privilage, Status) VALUES ('$receiver', '$id', '1', '0')";
    	mysqli_query($link, $query);
    	header("Location:club_admin.php"); 
    }


    if(isset($_POST['decline'])){
		$id = $_POST['id'];
		$title = $_POST['requestTitle'];
		$receiver = $_POST['requestName'];

		$subject = "Club request status on ". $title;
		$message = "Sorry your request has been denied";
		$query = "DELETE FROM CLUB WHERE ClubID = '$id'";
		mysqli_query($link, $query);
		$query ="INSERT INTO MAILBOX (Subject, MsgTime, MsgText, Sender, Receiver,Status) VALUES ('$subject', NOW(), '$message', '$userName', '$receiver', '5')";
    	mysqli_query($link, $query);
    	header("Location:club_admin.php"); 
    }





mysqli_close($link);
?>


 </table>


<?php
require('./includes/footer.inc.php');
?>