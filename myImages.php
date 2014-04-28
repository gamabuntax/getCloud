	<?php 
	$page_title = 'getCloud | MyFiles';
	require('./includes/header.inc.php');

	if (isset($_SESSION['userName'])) {
		$userName = $_SESSION['userName'];
		$_SESSION['prevURL'] = $_SERVER['REQUEST_URI'];
	}
	else {
		header("Location:register.php");
	}
?>

<?php

	/*
	function displaySharebutton($fileStatus, $fileID){
    	echo "<div align='center'>
    			<form method='post' action='./modules/sharemanager.php'>
    			<input type='hidden' name='fileID' value='".$fileID."'/>
    			<input type='hidden' name='fileStatus' value='".$fileStatus."'/>
		        <button type='submit' name='share' class='imgbtn'>Share</button>
		      	</form>
		      </div>";
	}*/

	function displayFiles(){
        require('./includes/mysql_connect.inc.php');
        $user = $_SESSION['userName'];
        $query = "SELECT * FROM FILE WHERE Owner='$user' AND Type!='application/pdf' ORDER BY FileID DESC";
        $result = mysqli_query($link, $query)or die("Error:".mysqli_error($link));

        while($row = mysqli_fetch_array($result)){
      		$cap = $row['Caption'];
	        $name = $row['Filename'];
	        $file = base64_encode($row['Data']);
	        $type = $row['Type'];
	        $abrvname = "";
	        $i = 0;
	        while($i < strlen($name) && $i < 10){
	        	$abrvname = $abrvname.$name[$i];
	        	$i++;
	        }
	        if (strlen($name) > 10){
	        	$abrvname = $abrvname."...";
	        }

        	echo "<div style='float:left;'>
					<form method='post' action='aboutfile.php'>
						<input type='hidden' name='file' value='".$file."'/>
						<input type='hidden' name='type' value='".$type."'/>
	                    <input type='hidden' name='caption'  value='".$cap."'/>
	                    <input type='hidden' name='name'  value='".$name."'/>
		                <button type='submit' class='imgbtn' name='submit'>
		                	<img src='data:image;base64,".$file."'height='50' width='' alt='".$cap."'/>
		                </button>
		            </form>
		          </div>";        
       } 
        mysqli_close($link);   
    }

    function uploadStatus(){
        echo $_SESSION['uploadStatus']."<br>";
        $_SESSION['uploadStatus'] = "";
    }
?>

<div id="mainregion">
	<form  action="modules/uploadmanager.php" method="post" enctype="multipart/form-data">
        <input type="submit" value="Upload" class="btn btn-sm " style="float:right;" >

        <input type="text" name="caption" maxlength="100" placeholder="Add a caption" style="float:right;" required>
        <input type="text" name="name" maxlength="30" placeholder="Name your file" style="float:right;" required>
        <input type="file"  name="file" style="float:right;" required>
        
    </form>
    <br><br>
    <?php uploadStatus(); ?>
    <ul id="tabs" class="nav nav-tabs">
        <li class="active"><a href="myImages.php" >Image</a></li>
        <li><a href="myPDFs.php">PDF</a></li>
    </ul>
    <?php displayFiles(); ?>
</div>

<?php
require('./includes/footer.inc.php');
?>



