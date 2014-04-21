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
	// TODO
	function displayFiles(){
        require('./includes/mysql_connect.inc.php');
        $user = $_SESSION['userName'];
        $query = "SELECT * FROM FILE WHERE Owner='$user'";
        $result = mysqli_query($link, $query)or die("Error:".mysqli_error($link));
        mysqli_close($link);

        echo "<table width='100%'>
        		  <tr>
        		  <td width='10%'></td>
        		  <td width='20%'><b>Name</b></td>
        		  <td width='70%'><b>Caption</b></td>
        		  </tr>";
        while($row = mysqli_fetch_array($result)){
      		$cap = $row['Caption'];
	        $name = $row['Filename'];

        	if ($row['Type'] == "application/pdf"){
        		$file = base64_encode($row['Data']);
				echo "<tr>
					  <td hight='50' width='10%'>
						  <form method='post' action='./modules/showpdf.php' target='_blank'>
						  	  <input type='hidden' name='pdf' value='".$file."'/>
	                      	  <input type='hidden' name='caption'  value='".$cap."'/>
	                          <input type='hidden' name='name'  value='".$name."'/>
		                      <button type='submit' class='imgbtn'>
		                      	<img src='./includes/pdfthumb.png' height='' width='50' alt='".$cap."'/>
		                      </button>
		                  </form>
	                  </td>
					  <td width='20%'>".$name."</td>
					  <td width='70%'>".$cap."</td>
					  </tr>";
        	}
        	else{
	            $pic = base64_encode($row['Data']);
	            
	            echo "<tr>
	            	  <td hight='50' width='10%'>
	            	  <form method='post' action='./modules/showimg.php' target='_blank'>
	                      <input type='hidden' name='picture'  value='".$pic."'/>
	                      <input type='hidden' name='caption'  value='".$cap."'/>
	                      <input type='hidden' name='name'  value='".$name."'/>
	                      <button type='submit' class='imgbtn' target='_blank'>
	                      	<img src='data:image;base64,".$pic."'
	                      	height='100%' width='50' alt='".$row['Caption']."'/>
	                      </button>
	                  </form></td>
	                  <td width='20%'>".$name."</td>
	                  <td width='70%'>".$cap."</td>
	                  </tr>";   
	        }          
       }
       echo "</table>";      
    }

    function uploadStatus(){
        echo $_SESSION['uploadStatus'];
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


