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
    <title><?php echo $page_title; ?></title>
    <?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>

    <!-- Bootstrap core CSS -->
    <link href="./includes/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./includes/custom.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="./index.php">GETCLOUD</a>
        </div>
        <div class="navbar-collapse collapse">
   
          <ul class="nav navbar-nav pull-right">
            <li <?php if ($currentPage == 'index.php') { echo 'class="active"';} ?>><a href="#">Home</a></li>
            <?php
            if (!isset($_SESSION['userName'])) {
                echo'<li><a href="./login.php">Log in</a></li>';
            }
            else {
            echo '<li class="dropdown">';
              echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' .$_SESSION['userName'] . ' <b class="caret"></b></a>';
              echo '<ul class="dropdown-menu">';
              echo '<li><a href="./inbox.php">Inbox</a></li>';
              echo '<li><a href="./change_password.php">Change password?</a></li>';
              echo ' <li class="divider"></li>';
              echo '<li><a href="./includes/logout.php">Logout</a></li>';
              echo '</ul>';
            echo '</li>';
            }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
    <div class="main">


