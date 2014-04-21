

<div id="sideregion">
	<?php echo '<h3>' . $userName . '</h3>'; ?>
  <ul class="nav nav-sidebar">
<<<<<<< HEAD
    <li class="active"><a href="compose.php">Compose</a></li>
    <li><a href="#">Inbox</a></li>
    <li><a href="#">Sent Mail</a></li>
    <li class="active"><a href="myfiles.php">My Files</a></li>
=======

    <li <?php if ($currentPage == 'compose.php') { echo 'class="active"';} ?>><a href="compose.php">Compose</a></li>
    <li <?php if ($currentPage == 'inbox.php') { echo 'class="active"';} ?>><a href="inbox.php">Inbox</a></li>
    <li <?php if ($currentPage == 'outbox.php') { echo 'class="active"';} ?>><a href="outbox.php">Outbox</a></li>
    <li><a href="#">My Files</a></li>
>>>>>>> 8e4025a703471aa8a2a27a761150fc7d526195c8
    <li><a href="#">My Clubs</a></li>
  </ul>

  <form name="logoutForm" action= "./includes/logout.php" method="post">
	<input type="submit" name = "logout" class="btn btn-default" value="Log out">
	</form>



</div>