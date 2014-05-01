<?php
	if (isset($_POST['upload'])) {
		$valid_val = array(false,false);
		if (isset($_FILES['file'])) {
			$allowed = array('image/jpeg', 'image/JPG', 'image/jpg', 'application/pdf');
			//check for the correct format.
			if (in_array($_FILES['file']['type'], $allowed)) {
				$valid_val[0] = true;
			}
			else {
				$valid_val[0] = false;
				echo '<button type="button" class="btn btn-danger center-block">Please upload a jpg or pdf file!</button>';
			}
		}
		else {
			$valid_val[0] = false;
			echo '<button type="button" class="btn btn-danger center-block">Please select your file</button>';
			//exit;
		}

		if (!empty($_POST['name']) && !empty($_POST['caption'])) {
			$valid_val[1] = true;
			$name = trim($_POST['name']);
			$caption = trim($_POST['caption']);
		}

		else {
			$valid_val[1] = false;
			echo '<button type="button" class="btn btn-danger center-block">Please enter name/caption</button>';
			//exit;
		}

		if ($valid_val[0] == true && $valid_val[1] == true) {
			 $file = file_get_contents($_FILES['file']['tmp_name']);
			 if (upload($file)){ 
			 	echo '<button type="button" class="btn btn-success center-block">Upload file successfuly</button>';
			 }

			 else {
			 	echo '<button type="button" class="btn btn-danger center-block">Something wrong. File not uploaded</button>';
			 }
		}
	}
?>

<form action="<?php echo $currentPage; ?>" class="form-inline" method="post" enctype="multipart/form-data">
		<input type="file" name="file">
		<input type="text" class="form-control" name="name" maxlength="30" placeholder="Name your file">
        <input type="text" class="form-control" name="caption" maxlength="100" placeholder="Add a caption">
        <input type="submit" name ="upload" value="Upload" class="btn btn-default " >
</form>

   <br>