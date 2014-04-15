

<div id="sideregion">
	<?php echo '<h3>' . $userName . '</h3>'; ?>
  <ul class="nav nav-sidebar">

    <li <?php if ($currentPage == 'compose.php') { echo 'class="active"';} ?>><a href="compose.php">Compose</a></li>
    <li <?php if ($currentPage == 'inbox.php') { echo 'class="active"';} ?>><a href="inbox.php">Inbox</a></li>
    <li><a href="#">Sent Mail</a></li>
    <li><a href="#">My Files</a></li>
    <li><a href="#">My Clubs</a></li>
  </ul>

  <form name="logoutForm" action= "" method="post">
	<input type="submit" name = "logout" class="btn btn-default" value="Log out">
	</form>

<?php
	if (isset($_POST['logout'])) {
		unset($_SESSION['userName']);
		session_destroy();
		header("Location:login.php");
	}
?>

</div>