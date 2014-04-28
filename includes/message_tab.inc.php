<ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li <?php if ($currentPage == 'inbox.php' || $_SESSION['msgType'] == 0) { echo 'class="active"';} ?>><a href="inbox.php" >Inbox</a></li>
        <li <?php if ($currentPage == 'outbox.php'|| $_SESSION['msgType'] == 1) { echo 'class="active"';} ?>><a href="outbox.php" >Outbox</a></li>
        <li <?php if ($currentPage == 'compose.php') { echo 'class="active"';} ?>><a href="compose.php" >Compose a message</a></li>
</ul>
<br>