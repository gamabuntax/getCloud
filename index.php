<?php 
$page_title = 'getCloud | index';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
	header("Location:inbox.php");
}
else {
	header("Location:register.php");
}
?>


<?php
require('./includes/footer.inc.php');
?>