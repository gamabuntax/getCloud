<?php 
$page_title = 'getCloud | My clubs';
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
 	$q = "SELECT CLUB.ClubName, CLUB.Description, CLUB.ClubID, CLUB.ProfileImage, MEMBER.Privilage FROM MEMBER, CLUB WHERE MEMBER.Username ='$userName' AND MEMBER.Status = '0' AND CLUB.ClubID = MEMBER.ClubID";
 	$result = mysqli_query($link,$q);
 	if(mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_array($result, MYSQL_NUM)) {
            $file = base64_encode($row[3]);

            if ($row[4] == 0) {
                $userPrivilage = "Member";
            }

            else {
                $userPrivilage = "Moderator";
            }

			echo '<tr>

            <td width="10%"><img src="data:image;base64,'.$file.'" height="50" width=""></td>

			 <td width="10%"><form action="viewClub.php" method="post">
                   <input type="hidden" name="ClubID"  value="'.$row[2].'">	
                    <button class="button-link" type="submit">' . $row[0]. '</button></form></td>

             <td width="40%"><form action="viewClub.php" method="post">
                   <input type="hidden" name="ClubID"  value="'.$row[2].'">	
                    <button class="button-link" type="submit">' . $row[1]. '</button></form></td>

             <td width="10%"><form action="viewClub.php" method="post">
                   <input type="hidden" name="ClubID"  value="'.$row[2].'"> 
                    <button class="button-link" type="submit">' . $userPrivilage. '</button></form></td>


            <td width = "10%"><form action="myclubs.php" method="post">
                    <input type="hidden" name="ClubID"  value="'.$row[2].'">
                    <button type="submit" name="request" class="btn btn-default">Leave the club?</button></form>
                    </td></tr>';
		}
	}

    if (isset($_POST['request'])) {
        $clubID = $_POST['ClubID'];
        $q = "DELETE FROM MEMBER WHERE ClubID = '$clubID' AND Username = '$userName'";
        $result = mysqli_query($link,$q);
        header("Location:myclubs.php");

        
    }


mysqli_close($link);
?>


</table>


<?php
require('./includes/footer.inc.php');
?>