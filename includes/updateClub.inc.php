<br>

<div class ="clear-all">
<h1>Update club profile</h1>
<?php
if (isset($_POST['update_name'])) {
	if (!empty($_POST['club_name'])) {
		$club_name = trim($_POST['club_name']);
		$clubID = $_POST['ClubID'];
		require('./includes/mysql_connect.inc.php');
		$q = "UPDATE CLUB SET ClubName = '$club_name' WHERE ClubID='$clubID'";
		//$result = mysqli_query($link,$q);
		$result = pg_query($link,$q);
		//mysqli_close($link);
		pg_close($link);
		header("Location:moderator.php?ClubID=" . $_POST['ClubID']);
	}

	else {
		echo '<button type="button" class="btn btn-danger">Please enter new name</button>';
	}
}

if (isset($_POST['update_desc'])) {
	if (!empty($_POST['description'])) {
		$description = trim($_POST['description']);
		$clubID = $_POST['ClubID'];
		require('./includes/mysql_connect.inc.php');
		$q = "UPDATE CLUB SET Description = '$description' WHERE ClubID='$clubID'";
		//$result = mysqli_query($link,$q);
		$result = pg_query($link,$q);
		//mysqli_close($link);
		pg_close($link);
		header("Location:moderator.php?ClubID=" . $_POST['ClubID']);
	}

	else {
		echo '<button type="button" class="btn btn-danger">Please enter new club description</button>';
	}
}


if (isset($_POST['update_img'])) {
	$clubID = $_POST['ClubID'];
	if (isset($_FILES['file'])) {
			$allowed = array('image/jpeg', 'image/JPG', 'image/jpg');
			if (in_array($_FILES['file']['type'], $allowed)) {
				$file = file_get_contents($_FILES['file']['tmp_name']);
			 	require('./includes/mysql_connect.inc.php');
			 	//$escapedfile = mysqli_real_escape_string($link, $file);
			 	$escapedfile = pg_escape_string($link, $file);
			 	$q = "UPDATE CLUB SET ProfileImage = '$escapedfile' WHERE ClubID='$clubID'";
			 	//$result = mysqli_query($link,$q);
			 	$result = pg_query($link,$q);
				//mysqli_close($link);
				pg_close($link);
				header("Location:moderator.php?ClubID=" . $_POST['ClubID']);
			}

			else {
				echo '<button type="button" class="btn btn-danger">Please upload a jpg file!</button>';
			}
	}
	else {
			echo '<button type="button" class="btn btn-danger">Please select your file</button>';
		}
}


?>


<form class="form-inline" action="moderator.php" method="post">
	<input type="text" class="form-control" name="club_name" placeholder="Club name">
	<input type='hidden' name='ClubID' value= <?php echo '"'.$clubID .'"'; ?>>
	<button type="submit" name="update_name" class="btn btn-default">Update</button>
</form>

</div> 

<div class ="clear-all">
<form class="form-inline" action="moderator.php" method="post">
	<textarea name="description" cols="50" rows="4" maxlength="150" class="form-control" placeholder="Club description"></textarea>
	<input type='hidden' name='ClubID' value= <?php echo '"'.$clubID .'"'; ?>>
	<button type="submit" name="update_desc" class="btn btn-default">Update</button>
</form>

</div> 

<div class ="clear-all">
<form class="form-inline" action="moderator.php" method="post" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type='hidden' name='ClubID' value= <?php echo '"'.$clubID .'"'; ?>>
	<button type="submit" name="update_img" class="btn btn-default">Update</button>
</form>

</div> 