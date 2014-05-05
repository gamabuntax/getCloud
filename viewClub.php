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

<form action="viewClub.php" class="form-inline" method="post">
<input type="text" name="searchtext" class="form-control" maxlength="100" placeholder="Search by file name or caption">
<input type='hidden' name='ClubID' value= <?php echo "'".$clubID."'" ?>>
<button type="submit" name="search" class="btn btn-default">Search</button>
</form>	

<br>
<?php


if (isset($_POST['search'])) {
	if (!empty($_POST['searchtext'])) { 
		echo "<h1> Found </h1>";
		echo '
		<table class="table table-striped table- table-condensed hover row-clickable" >
        <tr class="message-header" >
            <td width="10%"></td>
            <td width="15%" ><strong>Name</strong></td>
            <td width="45%"><strong>Caption</strong></td>
            <td width="10%"><strong>Owner</strong></td>
             
        </tr>';

        $search = trim($_POST['searchtext']);
        $clubID = $_POST['ClubID'];

        require('./includes/mysql_connect.inc.php');
        $query = "SELECT FILE.Caption, FILE.Filename, FILE.Data, FILE.Type, FILE.FileID, FILE.Owner FROM FILE,SHAREDFILES
        			WHERE SHAREDFILES.ClubID ='$clubID' AND FILE.Filename = '$search' OR caption REGEXP '[[:<:]]" .$search. "[[:>:]]'
        			AND SHAREDFILES.FileID = FILE.FileID";

        $result = mysqli_query($link, $query);


        if (mysqli_num_rows($result) !=0) {
	        while($row = mysqli_fetch_array($result, MYSQL_NUM)){
				$cap = $row[0];
		        $name = $row[1];
		        $file = base64_encode($row[2]);
		        $type = $row[3];
		        $fileID = $row[4];
		        $owner = $row[5];
		        echo "<tr width='100%'>";
			        if ($type == "application/pdf") {
			            echo "<td width='10%'><img src='./thumbnails/pdfthumb.png' height='50' alt=''/></td>";
			        }
			        else {
			            echo '<td width="10%"><img src="data:image;base64,'.$file.'" height="50" width=""></td>';
			        }
			        echo "<td width='15%'>".$name . "</td>
	            	<td width='45%'>".$cap . "</td>
	            	<td width='10%'>".$owner . "</td>

	            	</tr>";
		    }
		}
		else {

			echo '<button type="button" class="btn btn-danger">No files found';
		}
		echo "</table>";	
	}

	#header("Location:viewClub.php?ClubID=" . $_POST['ClubID']);

}

?>









<h1> Shared files </h1>
 <table class="table table-striped table-condensed table-hover row-clickable" >
        <tr width='100%' class="message-header" >
            <td width="10%"></td>
            <td width="15%" ><strong>Name</strong></td>
            <td width="45%"><strong>Caption</strong></td>
            <td width="10%"><strong>Owner</strong></td>          
        </tr>

         <?php
        	require('./includes/mysql_connect.inc.php');
        	$query = "SELECT FILE.Caption, FILE.Filename, FILE.Data, FILE.Type, FILE.FileID, FILE.Owner FROM SHAREDFILES,FILE 
        			WHERE SHAREDFILES.ClubID ='$clubID' AND SHAREDFILES.FileID = FILE.FileID";
        	$result = mysqli_query($link, $query);

    		while($row = mysqli_fetch_array($result, MYSQL_NUM)){
    			$cap = $row[0];
		        $name = $row[1];
		        $file = base64_encode($row[2]);
		        $type = $row[3];
		        $fileID = $row[4];
		        $owner = $row[5];

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
            	<td width='10%'>".$owner . "</td>

            	</tr>";
		    }


		  ?>


</table>

<?php
require('./includes/footer.inc.php');
?>