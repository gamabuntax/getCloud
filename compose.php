<?php 
$page_title = 'getCloud | index';
require('./includes/header.inc.php');

if (isset($_SESSION['userName'])) {
	$userName = $_SESSION['userName'];
}
else {
	header("Location:register.php");
}

require('./includes/sideregion.inc.php');
?>

<div id="mainregion">
<h2>Compose Message</h2>




</div>



<?php
require('./includes/footer.inc.php');
?>