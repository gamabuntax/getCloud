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

	function is_shared($fileID){

        $user = $_SESSION['userName'];
        $query = "SELECT * FROM FILE WHERE Owner='$user'";
        $result = mysqli_query($link, $query)or die("Error:".mysqli_error($link));
        mysqli_close($link);


	}

	function displayFiles(){
        require('./includes/mysql_connect.inc.php');
        $user = $_SESSION['userName'];
        $query = "SELECT * FROM FILE WHERE Owner='$user'";
        $result = mysqli_query($link, $query)or die("Error:".mysqli_error($link));
        

        while($row = mysqli_fetch_array($result)){
      		$cap = $row['Caption'];
	        $name = $row['Filename'];
	        $abrvname = "";
	        $i = 0;
	        while($i < strlen($name) && $i < 10){
	        	$abrvname = $abrvname.$name[$i];
	        	$i++;
	        }
	        $abrvname = $abrvname."...";

        	if ($row['Type'] == "application/pdf"){
        		$file = base64_encode($row['Data']);
				echo "<div style='float:left;'>
						  <form method='post' action='./modules/showpdf.php' target='_blank'>
						  	  <input type='hidden' name='pdf' value='".$file."'/>
	                      	  <input type='hidden' name='caption'  value='".$cap."'/>
	                          <input type='hidden' name='name'  value='".$name."'/>
		                      <button type='submit' class='imgbtn'>
		                      	<img src='./thumbnails/pdfthumb.png' height='100' width='' alt='".$cap."'/>
		                      </button>
		                  </form>
		                 <p align='center'> ".$abrvname."</p>
	                  </div>";
        	}
        	else{
	            $pic = base64_encode($row['Data']);
	            
	            echo "<div style='float:left;'>
	            	  <form method='post' action='./modules/showimg.php' target='_blank'>
	                      <input type='hidden' name='picture'  value='".$pic."'/>
	                      <input type='hidden' name='caption'  value='".$cap."'/>
	                      <input type='hidden' name='name'  value='".$name."'/>
	                      <button type='submit' class='imgbtn' target='_blank'>
	                      	<img src='data:image;base64,".$pic."'
	                      	height='100' width='' alt='".$row['Caption']."'/>
	                      </button>
	                  </form>";
	            share();
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
<h2>My Files</h2>
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


