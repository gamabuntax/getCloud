<?php
ob_start();
session_start();
	//if (isset($_POST['logout'])) {
		unset($_SESSION['userName']);
		session_destroy();
		header("Location:../index.php");
	//}
?>