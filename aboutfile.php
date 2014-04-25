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
	function displayFileInfo(){

	}

	function displayPDFThumbnail(){
		echo "<br><div align='center'>
				<form method='post' action='showimg.php'>					
		            <button type='submit' class='imgbtn'>
		            	<img src='./thumbnails/pdfthumb.png' height='30' alt='".$_POST['caption']."'/>
		            </button>
		      	</form>
		      </div>";
	}

	function displayImageThumbnail(){
		echo "<br><div align='center'>
				<form method='post' action='showimg.php'>					
		            <button type='submit' class='imgbtn'>
		            	<img src='data:image;base64,".$_POST['file']."'height='200' width='' alt='".$_POST['caption']."'/>
		            </button>
		      	</form>
		      </div>";
	}
?>







<div id="mainregion">
	<ul id="tabs" class="nav nav-tabs">
        <li class="active"><a href="myImages.php" >Image</a></li>
        <li><a href="myPDFs.php">PDF</a></li>
    </ul>
	<?php 
		if(isset($_POST['submit'])){
			if($_POST['type'] == "application/pdf"){
				echo $_POST['type'];
				displayPDFThumbnail();
			}
			else{
				displayImageThumbnail();
			}
			displayFileInfo();


		}


	?>



</div>


<?php
require('./includes/footer.inc.php');
?>