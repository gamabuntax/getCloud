<?php 
	$page_title = 'getCloud | MyFiles';
	require('./includes/header.inc.php');

	if (isset($_SESSION['userName'])) {
		$userName = $_SESSION['userName'];
	}
	else {
		header("Location:register.php");
	}
	require('./includes/sideregion.inc.php');
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
        $query = "SELECT * FROM FILE WHERE Owner='$user'";
        $result = mysqli_query($link, $query)or die("Error:".mysqli_error($link));

        while($row = mysqli_fetch_array($result)){
      		$cap = $row['Caption'];
	        $name = $row['Filename'];
	        $file = base64_encode($row['Data']);
	        $abrvname = "";
	        $i = 0;
	        while($i < strlen($name) && $i < 10){
	        	$abrvname = $abrvname.$name[$i];
	        	$i++;
	        }
	        if (strlen($name) > 10){
	        	$abrvname = $abrvname."...";
	        }

        	if ($row['Type'] == "application/pdf"){
				echo "<div style='float:left;'>
						 
						  <form method='post' action='./modules/showpdf.php' target='_blank'>
						  	  <input type='hidden' name='pdf' value='".$file."'/>
	                      	  <input type='hidden' name='caption'  value='".$cap."'/>
	                          <input type='hidden' name='name'  value='".$name."'/>
		                      <button type='submit' class='imgbtn'>
		                      	<img src='./thumbnails/pdfthumb.png' height='50' width='' alt='".$cap."'/>
		                      </button>
		                      </form>";
		                         
	            //displaySharebutton($row['Status'], $row['FileID']);
	            echo "</div>"; 
        	}
        	else{ 
	            echo "<div style='float:left;'>
	  	            	  <form method='post' action='./modules/showimg.php' target='_blank'>
		                      <input type='hidden' name='picture'  value='".$file."'/>
		                      <input type='hidden' name='caption'  value='".$cap."'/>
		                      <input type='hidden' name='name'  value='".$name."'/>
		                      <button type='submit' class='imgbtn' target='_blank'>
		                      	<img src='data:image;base64,".$file."'height='150' width='' alt='".$row['Caption']."'/>'
		                      </button>
		                  </form>";
	                
	             //displaySharebutton($row['Status'], $row['FileID']);
	            echo "</div>";
	        }          
       } 
        mysqli_close($link);   
    }

    function uploadStatus(){
        echo $_SESSION['uploadStatus']."<br>";
        $_SESSION['uploadStatus'] = "";
    }
?>

<div id="mainregion">
	<b style='float:left;'>Upload:</b>
	<form action="modules/uploadmanager.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" style="float:left;" required>
        <input type="text" name="name" maxlength="30" placeholder="Name your file" style="float:left;" required>
        <input type="text" name="caption" maxlength="100" placeholder="Add a caption" style="float:left;" required>
        <input type="submit" value="Upload" class="btn btn-sm btn-primary" > 
    </form>

    <?php 
    	uploadStatus(); 
    	displayFiles();
    ?>
</div>

<?php
require('./includes/footer.inc.php');
?>


