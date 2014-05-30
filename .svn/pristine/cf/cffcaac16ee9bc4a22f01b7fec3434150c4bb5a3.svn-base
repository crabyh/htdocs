<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php //include 'check_access.php'; ?>

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
$query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
$data = mysqli_query($dbc,$query);
if(mysqli_num_rows($data)==1){
  $row = mysqli_fetch_array($data);
  $_SESSION['department'] = $row['department'];
  $_SESSION['gender'] = $row['gender'];
  $_SESSION['birthyear'] = $row['birthyear'];
  $_SESSION['birthmonth'] = $row['birthmonth'];
  $_SESSION['birthday'] = $row['birthday'];
  $_SESSION['enroll_time'] = $row['enroll_time'];
  $_SESSION['phone'] = $row['phone'];
  $_SESSION['email'] = $row['email'];
  }
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
          <h1>User Infomation <small><button class="btn btn-default" id='1'>Edit</button></small></h1>
        </div>

        <!-- page body -->
        <form class="form-horizontal">

        <div class="form-group" >
          <label class="col-sm-2 control-label">User ID</label>
          <div class="col-sm-4">
            <p class="form-control-static" id='0'><?php echo $_SESSION['user_id'];?></p>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">User Name</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="2"><?php echo $_SESSION['username'];?></p>
          </div>
        </div>
         
        <div class="form-group" >
          <label class="col-sm-2 control-label">Department</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="3"><?php echo $_SESSION['department'];?></p>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Gender</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="4"><?php echo $_SESSION['gender'];?></p>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Birth Day</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="5"><?php echo $_SESSION['birthyear']."-".$_SESSION['birthmonth']."-".$_SESSION['birthday'];?></p>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Enroll time</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="6"><?php echo $_SESSION['enroll_time'];?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Phone</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="7"><?php echo $_SESSION['phone'];?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="8"><?php echo $_SESSION['email'];?></p>
          </div>
        </div>
      </form>

      <!-- <div class="form-group">
          <label class="col-sm-2 control-label"> </label>
          <div class="col-sm-4">
            <p class="form-control-static"><a href="change_user_info.php">change user info</a></p>
          </div>
      </div> -->

      </div>
    </div>

    <!-- clear user_info Session -->
    <?php
      unset($_SESSION['department']);
      unset($_SESSION['gender']);
      unset($_SESSION['birthyear']);
      unset($_SESSION['birthmonth']);
      unset($_SESSION['birthday']);
      unset($_SESSION['enroll_time']);
      unset($_SESSION['phone']);
      unset($_SESSION['email']);
    ?>

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>