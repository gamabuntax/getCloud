<?php 
$page_title = 'getCloud | Clubs';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

require('./includes/view_club_tab.inc.php');
?>


 <table class="table table-striped table-condensed table-hover row-clickable" >
        <tr width='100%' class="message-header" >
            <td width="10%"></td>
            <td width="15%" ><strong>Name</strong></td>
            <td width="45%"><strong>Caption</strong></td>
            <td width="10%"><strong>Action</strong></td>             
        </tr>

        <?php
        	require('./includes/mysql_connect.inc.php');
        	$query = "SELECT * FROM FILE WHERE Owner='$userName'";
        	$result = mysqli_query($link, $query);

    		while($row = mysqli_fetch_array($result)){
    			$cap = $row['Caption'];
		        $name = $row['Filename'];
		        $file = base64_encode($row['Data']);
		        $type = $row['Type'];
		        $fileID = $row['FileID'];

		        echo "<tr width='100%'>";
		        if ($type == "application/pdf") {
		            echo ' <td width="10%"><form action="viewPDF.php" method="post"  target="_blank">
                    <input type="hidden" name="file"  value="'.$file.'"> 
                    <button class="button-link" type="submit"><img src="./thumbnails/pdfthumb.png" height="50"/></button></form></td>';
		        }
		        else {
		            echo ' <td width="10%"><form action="viewImage.php" method="post"  target="_blank">
                    <input type="hidden" name="file"  value="'.$file.'"> 
                    <button class="button-link" type="submit"><img src="data:image;base64,' . $file. '" height="50" width=""></button></form></td>';
		        }
		        echo "<td width='15%'>".$name . "</td>
            	<td width='45%'>".$cap . "</td>
            	<td width='20%'><form class='form-inline' action='share_file.php' method='post'>
	            <select class='form-control' name='sharing'>
	            <option value='share'>Share to the club</option>
	            <option value='noshare'>Dont share</option>
	            </select>
	            <input type='hidden' name='file_id' value='".$fileID."'/>
	            <input type='hidden' name='ClubID' value='".$clubID."''>
	            <button type='submit' name ='submit' class='btn btn-default'>Submit</button>
	            </form></td>
            	</tr>";
    		}

    		if (isset($_POST['submit'])) {
    			$sharing = $_POST['sharing'];
				$file_id = $_POST['file_id'];
				$clubID = $_POST['ClubID'];
				require('./includes/mysql_connect.inc.php');
				if ($sharing == 'share') {
					$q = "INSERT INTO SHAREDFILES(FileID, ClubID) VALUES ('$file_id', '$clubID')";
					$result = mysqli_query($link, $q);
				}

				else {
					$q = "DELETE FROM SHAREDFILES WHERE FileID='$file_id' AND ClubID='$clubID'";
					$result = mysqli_query($link, $q);
				}
				header("Location:share_file.php?ClubID=" . $_POST['ClubID']);
    		}
        ?>
  </table>

<?php
require('./includes/footer.inc.php');
?>