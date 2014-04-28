<?php

if (isset($_POST['ClubID'])) {
	$clubID = $_POST['ClubID'];
}
elseif (isset($_GET['ClubID'])) {
	$clubID = $_GET['ClubID'];
}

else {}	

require('./includes/mysql_connect.inc.php');
$q = "SELECT CLUB.ClubName, CLUB.Description FROM CLUB WHERE ClubID ='$clubID'";
$result = mysqli_query($link,$q);
$row = mysqli_fetch_array($result, MYSQL_NUM);
   echo '<h2>' . $row[0] . '</h2>';
   echo '<h6>' . $row[1] . '</h6>';
?>


<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">

        <li <?php if ($currentPage == 'viewClub.php') { echo 'class="active"';} 
        echo '><a href="viewClub.php?ClubID=' . $clubID . '">Club files</a>'; ?></li>
        
         <li <?php if ($currentPage == 'clubMembers.php') { echo 'class="active"';} 
        echo '><a href="clubMembers.php?ClubID=' . $clubID . '">Club members</a>'; ?></li>
</ul>
<br>