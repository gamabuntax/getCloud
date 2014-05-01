<?php 
	$page_title = 'getCloud | MyFiles';
	require('./includes/header.inc.php');

	if (isset($_SESSION['userName'])) {
		$userName = $_SESSION['userName'];
	}
	else {
		header("Location:register.php");
	}
?>

<?
function displaySearchFile($search){
    require('./includes/mysql_connect.inc.php');
    $userName = $_SESSION['userName'];
    //$query = "SELECT * FROM FILE WHERE Owner='$userName'";
    $query = "SELECT * FROM FILE WHERE Status='1' AND Filename = '$search' OR caption REGEXP '[[:<:]]" .$search. "[[:>:]]'";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) !=0) {
	    while($row = mysqli_fetch_array($result)){
	        $cap = $row['Caption'];
	        $uploader = $row['Owner'];
	        $name = $row['Filename'];
	        $type = $row['Type'];
	        $file = base64_encode($row['Data']);

	        echo "<tr width='100%'>";

	        if ($type == "application/pdf") {
	            echo "<td width='15%'><img src='./thumbnails/pdfthumb.png' height='50' alt=''/></td>";
	        }
	        else {
	            echo '<td width="15%"><img src="data:image;base64,'.$file.'" height="50" width="">';
	        }
	        echo "<td width='15%'>".$uploader . "</td>
	            <td width='20%'>".$name . "</td>
	            <td width='50%'>".$cap . "</td>
	          </tr>";       
	   }
	}
	else {
		echo '<button type="button" class="btn btn-danger">No files found';
	}

    mysqli_close($link);   
}
?>


<?php
require('./includes/file_tab.inc.php');
?>

<form action="searchFiles.php" class="form-inline" method="post">
<input type="text" name="searchtext" class="form-control" maxlength="100" placeholder="Search by file name or caption">
<button type="submit" name="search" class="btn btn-default">Search</button>
</form>	
<br>

 <table class="table table-striped table- table-condensed hover row-clickable" >
        <tr width='100%' class="message-header" >
            <td width="15%"></td>
            <td width="15%" ><strong>Uploader</strong></td>
            <td width="20%"><strong>Name</strong></td>
            <td width="50%"><strong>Caption</strong></td>
             
        </tr>

<?php
if (isset($_POST['search'])) {
	if (!empty($_POST['searchtext'])) {
		$search = trim($_POST['searchtext']);
		displaySearchFile($search);
	}


	else {
		echo '<button type="button" class="btn btn-danger">Please enter name/caption!</button>';		
	}


}
?>

</table>

<?php
require('./includes/footer.inc.php');
?>


