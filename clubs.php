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
                <td width="10%">
                    <strong></strong>
                </td>
                <td width="10%">
                    <strong>Club name</strong>
                </td>
                <td width="30%">
                    <strong>Club description</strong>
                </td>

                <td width="10%">
                    <strong>Status</strong>
                </td>
                <td width="10%">
                    <strong></strong>
                </td>

            </tr>

 <?php
 	require('./includes/mysql_connect.inc.php');
 	$q = "SELECT CLUB.ClubName, CLUB.Description, CLUB.ClubID, CLUB.ProfileImage FROM CLUB WHERE CLUB.Status = 2";
 	$result = pg_query($link,$q);
 	if(pg_num_rows($result) > 0) {
		while ($row = pg_fetch_array($result, PGSQL_NUM)) {
             $memberStatus = "";
            $file = base64_encode($row[3]);
            $q1 = "SELECT MEMBER.Status FROM MEMBER WHERE MEMBER.Username = '$userName' AND MEMBER.ClubID = '$row[2]'";
            $result1 = pg_query($link,$q1);
            if(pg_num_rows($result1) > 0) {
                $row1 = pg_fetch_array($result1, PGSQL_NUM);
                if ($row1[0] == 0) {
                    $memberStatus = "Active";
                }
                elseif ($row1[0] == 1) {
                    $memberStatus = "Banned";
                }

                else {
                    $memberStatus = "Pending";
                }
            }
            else {
                $memberStatus = "";
            }
			echo '<tr>
            <td width="10%"><img src="data:image;base64,'.$file.'" height="50" width=""></td>
			 <td width="10%">'. $row[0] .'</td>
             <td width="30%">'. $row[1] .'</td>
             <td width="10%">'. $memberStatus .'</td>';

             if (empty($memberStatus)) {
                echo '<td width = "10%"><form action="clubs.php" method="post">
                    <input type="hidden" name="id"  value="'.$row[2].'">
                    <button type="submit" name="request" class="btn btn-default">Join?</button></form>
                    </td></tr>';
             }
             else {
                echo '<td width = "10%"></td></tr>';
             } 
		}
	}

    if (isset($_POST['request'])) {
        $clubID = $_POST['id'];
        $q = "INSERT INTO MEMBER (Username,ClubID,Privilage, Status) VALUES ('$userName', '$clubID', '0', '2')";
        $result  = pg_query($link,$q);
        pg_close($link);
        header("Location:clubs.php");
    }
   pg_close($link);
?>

</table>


<?php
require('./includes/footer.inc.php');
?>