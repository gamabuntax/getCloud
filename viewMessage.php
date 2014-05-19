<?php 
$page_title = 'getCloud | Message';
require('./includes/header.inc.php');

if (isset($_SESSION['userName']) && isset($_SESSION['msgType'])) {
	$userName = $_SESSION['userName'];
   $msgType = $_SESSION['msgType'];
}
else {
	header("Location:register.php");
}

require('./includes/message_tab.inc.php');

?>


<?php
   $id = $_POST['msgID'];
   require('./includes/mysql_connect.inc.php');
   if ($msgType == 0) {
      //query for inbox
      $q = "SELECT Subject, Sender, MsgText, Status FROM MAILBOX WHERE MessageID ='$id'";
   }
   else {
      //query for outbox
      $q = "SELECT Subject, Receiver, MsgText FROM MAILBOX WHERE MessageID ='$id'";
   }

   $result = pg_query($link,$q);
   $row = pg_fetch_array($result, PGSQL_NUM);
   echo '<p> From: ' . $row[1] . '</p>';
   echo '<p> Subject: ' . $row[0] .'</p>';
   echo '<p> Message: ' . $row[2]. '</p>';

   pg_free_result($result);
   //inbox message
   if ($msgType == 0) {
      if ($row[3] == 1) {

         $q = "UPDATE MAILBOX SET Status = '2' WHERE MessageID = '$id'";
         $result = pg_query($link, $q);
      }

      if ($row[3] == 5) {
         $q = "UPDATE MAILBOX SET Status = '6' WHERE MessageID = '$id'";
         $result = pg_query($link, $q);
      }


      echo '<a href="inbox.php">Back</a>';
   }

   //outbox message
   else {
      echo '<a href="outbox.php">Back</a>';
   }

   pg_close($link);

 ?> 
<?php
require('./includes/footer.inc.php');
?>