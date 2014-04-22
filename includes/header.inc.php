<?php
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Note there is no responsive meta tag here -->

    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title><?php echo $page_title; ?></title>
    <?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>

    <!-- Bootstrap core CSS -->
     <link href="./includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
     <link href="./includes/custom.css" rel="stylesheet">
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php">GETCLOUD</a>
        </div>
        <div class="navbar-collapse collapse">
           <?php if (isset($_SESSION['userName'])) { ?>
          <ul class="nav navbar-nav">
       <!-- message -->
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Message <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="./compose.php">Compose</a></li>
                <li><a href="./inbox.php">Inbox</a></li>
                <li><a href="./outbox.php">Outbox</a></li>
              </ul>
            </li>

            <!-- club -->
          <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Clubs <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="./club_request.php">Request for a club</a></li>
                <li><a href="./myclubs.php">My clubs</a></li>
              </ul>
            </li>
            <li <?php if ($currentPage == 'myImages.php') { echo 'class="active"';} ?>><a href="./myImages.php">My files</a></li>
          </ul>

          <!-- file -->

          <?php } ?>

          <ul class="nav navbar-nav navbar-right">
             <!-- User -->

          <?php if (isset($_SESSION['userName'])) { ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <?php echo $_SESSION['userName']; ?>  <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="./change_password.php">Change password?</a></li>
                <li class="divider"></li>
                <li><a href="./includes/logout.php">Logout</a></li>
              </ul>
            </li>

            <?php } else {?>
            <li <?php if ($currentPage == 'register.php') { echo 'class="active"';} ?>><a href="./register.php">Register</a></li>
            <li <?php if ($currentPage == 'login.php') { echo 'class="active"';} ?>><a href="./login.php">Login</a></li>
            <?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
  <div class="main">
    
