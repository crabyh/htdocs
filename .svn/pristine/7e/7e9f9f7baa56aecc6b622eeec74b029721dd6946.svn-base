<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- include head file-->
<head>
<?php include 'header.php'; ?>
</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- CheckUserType -->
      <?php 
      include 'check_user_type.php';
      CheckUserType('admin');
      ?> 

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
        <?php
        if(isset($_SESSION['login'])) 
          echo'<div class="alert alert-success alert-dismissable">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4>
            Sign Out
          </h4> <strong>You have been sign out successful.</strong></a>
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
      		<h1>SystemLog Check</h1>
        </div>

        <!-- page body -->
        <!-- <p class="lead">Enjoy the system. Have fun!</p> -->
        <?php
        $file=fopen("SystemLog/SystemLog.txt","r")or exit("Unable to open SystemLog file!");
        while(!feof($file))
          {
           echo fgets($file). "<br />";
          }

        fclose($file);
        ?>




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