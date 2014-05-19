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
<?php
require('./includes/file_function.inc.php');
require('./includes/file_tab.inc.php');
require('./includes/upload_form.inc.php'); 

?>
    <table class="table table-striped table-condensed table-hover row-clickable" >
        <tr width='100%' class="message-header" >
            <td width="10%"></td>
           
            <td width="15%" ><strong>Name</strong></td>
            <td width="45%"><strong>Caption</strong></td>
             <td width="10%" ><strong>Status</strong></td>
            <td width="20%"><strong>Action</strong></td>
             
        </tr>

    	<?php
    	 $query = "SELECT * FROM FILE WHERE Owner='$userName'";
    	 displayFile($query); 
    	 ?>
    </table>

<?php
if (isset($_POST['submit'])) {

	$sharing = $_POST['sharing'];
	$file_id = $_POST['file_id'];
	$status1 = $_POST['status'];
	//echo $file_id;

	require('./includes/mysql_connect.inc.php'); 
	if ($sharing == 'private') {
		//echo "PRIVATE";
		//echo $status1;
		$query = "UPDATE FILE SET Status='0' WHERE 	FileID = '$file_id'";
		$result = pg_query($link, $query);
	}
	else {
		//echo "Public";
		//echo $status1;
		$query = "UPDATE FILE SET Status='1' WHERE 	FileID = '$file_id'";
		$result = pg_query($link, $query);
	}
	pg_close($link);
	header("Location:myFiles.php"); 
}

   
?>


<?php
require('./includes/footer.inc.php');
?>


