<?php 
$page_title = 'getCloud | index';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

require('./includes/admin_tab.inc.php');

$clubID = $_POST['id'];
$clubName = $_POST['clubname'];
echo '<h1>' . $clubName . '</h1>';
?>

<table class="table table-striped table-condensed table-hover row-clickable" width="100%">
            <tr class="message-header">
                <td  width="10%">
                    <strong>Member </strong>
                </td>
                <td  width="10%">
                    <strong>Status </strong>
                </td>
                <td  width="10%">
                    <strong>Action </strong>
                </td>
            </tr>


<?php
	
	require('./includes/mysql_connect.inc.php');
	$q = "SELECT MEMBER.Username, MEMBER.Privilage FROM MEMBER WHERE Status=0 and ClubID = '$clubID'";
	$result = mysqli_query($link,$q);
	if(mysqli_num_rows($result) > 0) {
	    while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
	    	if ($row[1] == 0) {
	    		$status = "Member";
	    	}
	    	else {
	    		$status = "Moderator";
	    	}

	    	echo '<tr>
	    	<td width ="10%">' . $row[0] . '</td>
	    	<td width ="10%">' . $status . '</td>

	    	<td width="10%"><form action="change_moderator.php" method="post">
                    <input type="hidden" name="member"  value="'.$row[0].'">
                    <input type="hidden" name="id"  value="'.$clubID.'">
                    <input type="hidden" name="clubname"  value="'.$clubName.'">
                    <button type="submit" name="changeModerator" class="btn btn-default">Moderator?</button></form>
                    </td>

	    	</tr>';
	    }
	} 

	if (isset($_POST['changeModerator'])) {
		$member = $_POST['member'];
		$clubID = $_POST['id'];

		$q = "UPDATE MEMBER SET  Privilage= 0 WHERE ClubID = '$clubID' AND Privilage =1";
		$result = mysqli_query($link,$q);
		$q = "UPDATE MEMBER SET Privilage=1 WHERE ClubID = '$clubID' AND Username = '$member'";
		$result = mysqli_query($link,$q);
		header("Location:club_admin.php");

	}

?>

</table>

<?php
require('./includes/footer.inc.php');
?>