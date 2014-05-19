<?php 
$page_title = 'getCloud | Inbox';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
	$_SESSION['msgType'] = 0;
}
else {
	header("Location:register.php");
}
?>

<?php
require('./includes/message_tab.inc.php');
?>

<h1>Inbox</h1>
 <table class="table table-striped table-condensed table-hover row-clickable" width="100%">
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
	
	$q = "SELECT MessageID, Sender, Subject, MsgTime, Status FROM MAILBOX WHERE Receiver = '$userName' AND Status IN (1,2,5,6) ORDER BY MsgTime DESC";
	$result = pg_query($link,$q);
	if(pg_num_rows($result) > 0) {
		while ($row = pg_fetch_array($result, PGSQL_NUM)) {
			if ($row[4] == 1 || $row[4] == 5) {
				echo '<tr class="">                  	       
                    <td width="20%"><form action="viewMessage.php" method="post">
                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
                    <button class="button-link" type="submit"><strong>' . $row[1]. '</strong></button></form></td>

                    <td width="45%"><form action="viewMessage.php" method="post">
                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
                    <button class="button-link" type="submit"><strong>' . $row[2]. '</strong></button></form></td>

                    <td width="20%"><form action="viewMessage.php" method="post">
                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
                    <button  class="button-link" type="submit"><strong>' . $row[3]. '</strong></button></form></td>

                    <td width="15%"><form action="inbox.php" method="post">
                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
                    <button type="submit" name="delete" class="btn btn-default">delete?</button></form></td>
              		</tr>';
			}

			else {
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

                    <td width="15%"><form action="inbox.php" method="post">
                    <input type="hidden" name="msgID"  value="'.$row[0].'">	
                  	<button type="submit" name="delete" class="btn btn-default">delete?</button></form></td>
              		</tr>';
                }
		}
	}
	else {
        echo '<tr><button type="button" class="btn btn-danger">You dont have any message </button></tr>';
	}

	if(isset($_POST['delete'])){
		$id = $_POST['msgID'];
		$query = "UPDATE MAILBOX SET Status = CASE Status WHEN 1 THEN 3 WHEN 2 THEN 4 WHEN 5 THEN 7 WHEN 6 THEN 7 END WHERE MessageID='$id'";
    	pg_query($link, $query);
    	header("Location:inbox.php"); 
    }

	pg_close($link);
 ?>
</table>

<?php
require('./includes/footer.inc.php');
?>