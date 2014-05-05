<?php

if (isset($_POST['ClubID'])) {
	$clubID = $_POST['ClubID'];
}
elseif (isset($_GET['ClubID'])) {
	$clubID = $_GET['ClubID'];
}

else {}	

require('./includes/mysql_connect.inc.php');
$q = "SELECT CLUB.ClubName, CLUB.Description, CLUB.ProfileImage FROM CLUB WHERE ClubID ='$clubID'";
$result = mysqli_query($link,$q);
$row = mysqli_fetch_array($result, MYSQL_NUM);
$file = base64_encode($row[2]);
   echo '<div class="float-left"><img src="data:image;base64,'.$file.'" height="100" width=""></div>';
   echo '<h2>' . $row[0] . '</h2>';
   echo '<h6>' . $row[1] . '</h6>';
   echo '<div class="clear-all"></div>';


$q = "SELECT Privilage FROM MEMBER WHERE ClubID ='$clubID' AND Username = '$userName' ";
$result = mysqli_query($link,$q);
$row = mysqli_fetch_array($result, MYSQL_NUM);

mysqli_close($link);

if ($row[0] == 0 && $currentPage == "moderator.php") {
     header("Location:myclubs.php");
}

?>


<br>
<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

        <li <?php if ($currentPage == 'viewClub.php') { echo 'class="active"';} 
        echo '><a href="viewClub.php?ClubID=' . $clubID . '">Club files</a>'; ?></li>
                   
        <li <?php if ($currentPage == 'share_file.php') { echo 'class="active"';} 
        echo '><a href="share_file.php?ClubID=' . $clubID . '">Your files</a>'; ?></li>

        <?php if ($row[0] == 1) { ?>   
        <li <?php if ($currentPage == 'moderator.php') { echo 'class="active"';} 
        echo '><a href="moderator.php?ClubID=' . $clubID . '">Moderator page</a>'; ?></li>

      <?php } ?>  

</ul>
<br>