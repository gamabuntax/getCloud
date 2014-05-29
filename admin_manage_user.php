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
?>

<h1>Users</h1>

 <table class="table table-striped table-condensed table-hover row-clickable">
            <tr class="message-header">
                <td width="10%">
                    <strong>User</strong>
                </td>

                <td width="10%">
                    <strong>Action</strong>
                </td>

            </tr>


<?php
	require('./includes/mysql_connect.inc.php');
	$q = "SELECT Username FROM USERS WHERE Status=0";
	//$result = mysqli_query($link,$q);
	$result = mysqli_query($link,$q);
	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
			echo '<tr>
				<td width ="10%">' . $row[0] . '</td>

				<td width ="10%">
				<form action="admin_manage_user.php" method="post">
                     <input type="hidden" name="user"  value="'.$row[0].'">		
                    <button type="submit" name="remove" class="btn btn-default">Remove</button></form></td></tr>';

		}
	}

	if (isset($_POST['remove'])) {
		$user = $_POST['user'];
		$q = "DELETE FROM USERS, FILE WHERE Username = '$user'";
		$result = mysqli_query($link,$q);
		header("Location:admin_manage_user.php");
	}
?>

            </table>


<?php
require('./includes/footer.inc.php');
?>