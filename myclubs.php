<?php 
$page_title = 'getCloud | My clubs';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

?>


<h3> Your request status </h3>

<a href="./club_request.php">Request a new club</a>






<?php
require('./includes/footer.inc.php');
?>