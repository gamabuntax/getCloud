<?php 
$page_title = 'getCloud | Clubs';
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

 <table class="table table-striped table-condensed table-hover row-clickable" width="60%">
            <tr class="message-header">
                <td width="30%">
                    <strong>Club name</strong>
                </td>
                <td width="70%">
                    <strong>Club description</strong>
                </td>
            </tr>


 <?php
 	require('./includes/mysql_connect.inc.php');
 	$q = "SELECT CLUB.ClubName, CLUB.Description, CLUB.ClubID FROM CLUB WHERE Status = 2";
 	$result = mysqli_query($link,$q);
 	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
			echo '<tr>
			 <td width="30%"><form action="viewClub.php" method="post">
                   <input type="hidden" name="ClubID"  value="'.$row[2].'">		
                    <button class="button-link" type="submit">' . $row[0]. '</button></form></td>

             <td width="70%"><form action="viewClub.php" method="post">
                   <input type="hidden" name="ClubID"  value="'.$row[2].'">	
                    <button class="button-link" type="submit">' . $row[1]. '</button></form></td></tr>';
		}
	}

?>

</table>


<?php
require('./includes/footer.inc.php');
?>