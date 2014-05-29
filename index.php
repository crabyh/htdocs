<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<!-- checking access status -->
<?php
if(isset($_SESSION["user_id"]))
  echo'
  <script type="text/javascript"> 
  setTimeout(window.location.href="loged.php",3); 
  </script>';
?>
<!-- include head file-->
<head>
<?php include 'header.php'; ?>
</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
        <?php
        if(isset($_SESSION['login'])) 
          echo'<div class="alert alert-success alert-dismissable">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4>
            Sign Out
          </h4> <strong>You have been signed out successfully.</strong></a>
        </div>';
        else if(isset($_SESSION['illegal']))
          echo'<div class="alert alert-danger fade in"">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4>
            Illegal Access
          </h4> <strong>xxxxxxx.</strong></a>
        </div>';
        unset($_SESSION['login']);
        unset($_SESSION['illegal']);
        ?>
      		<h1>Welcome to Education Sever System</h1>
        </div>

        <!-- page body -->
        <p class="lead">It's a simple Education Sever System implemented by Group 1. And it's our team 1's job to implement the welcome, sign in and basic-infomation-maneger pages. have fun!</p>
        <p class="lead">before you start using the system, please Sign In first.</p>
        <p><a class="btn btn-lg btn-success" href="login.php" role="button">Sign In Now</a></p>
      </div>
    </div>

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
