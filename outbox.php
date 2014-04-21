<?php 
$page_title = 'getCloud | Outbox';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
	$_SESSION['msgType'] = 1;
}
else {
	header("Location:register.php");
}

require('./includes/sideregion.inc.php');
?>

<div id="mainregion">
      <table class="table table-striped table-condensed" width="100%">
                <tr class="message-header">
                    <td width="20%">
                        <strong>Sender</strong>
                    </td>
                    <td width="45%">
                        <strong>Subject</strong>
                    </td>
                    <td width="20%">
                        <strong>Date</strong>
                    </td>
                    <td width="15%">
                        <strong>Action</strong>
                    </td>
                </tr>
     <?php
     	require('./includes/mysql_connect.inc.php');
		
		$q = "SELECT MessageID, Receiver, Subject, MsgTime, Status FROM MAILBOX WHERE Sender = '$userName' AND Status IN (1,2,3,4) ORDER BY MsgTime DESC";
		$result = mysqli_query($link,$q);
		if(mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
				echo '<tr>                  	       
	                    <td width="20%"><form action="viewMessage.php" method="post">
	                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
	                    <button class="button-link" type="submit">' . $row[1]. '</button></form></td>

	                    <td width="45%"><form action="viewMessage.php" method="post">
	                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
	                    <button class="button-link" type="submit">' . $row[2]. '</button></form></td>
	                    
	                    <td width="20%"><form action="viewMessage.php" method="post">
	                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
	                    <button class="button-link" type="submit">' . $row[3]. '</button></form></td>

	                    <td width="15%"><form action="outbox.php" method="post">
	                    <input type="hidden" name="delete"  value="'.$row[0].'">	
	                    <button class="button-link" type="submit" class="btn btn-xs"><img src="./includes/delete.png" /></button></td>
	              		</tr>';
			}
		}

		else {
			echo '<tr><p class="error">You dont have any message.</p></tr>';	
		}

		if(isset($_POST['delete'])){
			$id = $_POST['delete'];
			$query = "UPDATE MAILBOX SET Status = CASE Status WHEN 1 THEN 5 WHEN 2 THEN 6 WHEN 3 THEN 7 WHEN 4 THEN 7 END WHERE MessageID='$id'";
					
        	mysqli_query($link, $query);
        	header("Location:outbox.php"); 
        }
		mysqli_close($link);
     ?>
    </table>
</div>



<?php
require('./includes/footer.inc.php');
?>