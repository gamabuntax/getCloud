<?php 
$page_title = 'getCloud | Clubs';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

	require('./includes/view_club_tab.inc.php');
?>


<?php
require('./includes/footer.inc.php');
?>