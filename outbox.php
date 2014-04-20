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
                <tr>
                    <td width="20%">
                        <strong>Sender</strong>
                    </td>
                    <td width="40%">
                        <strong>Subject</strong>
                    </td>
                    <td width="20%">
                        <strong>Date</strong>
                    </td>
                    <td width="20%">
                        <strong>Action</strong>
                    </td>
                </tr>
     <?php
     	require('./includes/mysql_connect.inc.php');
		
		$q = "SELECT MessageID, Receiver, Subject, MsgTime, Status FROM MAILBOX WHERE Sender = '$userName' AND Status IN (1,2,4) ORDER BY MsgTime DESC";
		$result = mysqli_query($link,$q);
		if(mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
				if ($row[4] <2) {
					echo '<tr class="">                  	       
	                    <td width="20%"><strong>'.$row[1].'</strong></td>
	                    <td width="40%"><form action="viewMessage.php" method="post">
	                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
	                    <button type="submit"><strong>' . $row[2]. '</strong></button></form></td>
	                    <td width="20%"><strong>' . $row[3]. '</strong></td>
	                    <td width="20%"> delete' . '</td>
	                    </tr>';
					
				}
				else {
					echo '<tr>                  	       
	                    <td width="20%">'.$row[1].'</td>
	                    <td width="40%"><form action="viewMessage.php" method="post">
	                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
	                    <button type="submit">' . $row[2]. '</button></form></td>
	                    <td width="20%">' . $row[3]. '</td>
	                    <td width="20%"> delete' . '</td>
	                    </tr>';
	                }

			}
		}

		else {
			echo '<tr ><td class="error">You dont have any message.</td></tr>';	
		}
		mysqli_close($link);
     ?>
    </table>
</div>



<?php
require('./includes/footer.inc.php');
?>