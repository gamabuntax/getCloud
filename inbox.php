<?php 
$page_title = 'getCloud | Inbox';
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
<p>This is a test</p>
</div>



<?php
require('./includes/footer.inc.php');
?>