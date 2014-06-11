<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php //include 'check_access.php'; ?>

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$course_id=$_GET['course_id'];
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
$query = "SELECT * FROM course_info WHERE cid='$course_id'";
$data = mysqli_query($dbc,$query);
if(mysqli_num_rows($data)==1)
  $row = mysqli_fetch_array($data);
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
          <h1>Course Infomation <small>
            <button class="btn btn-default" id="1">Edit</button></small>
          </h1>
        </div>

        <?php
          if(isset($_POST['submit'])){
            $data = FALSE;
            if($_POST['cname']!=''){
              $phone=$_POST['phone'];
              $query = "UPDATE user_info SET phone = '$phone' WHERE user_id = '$user_id'";
              $data = mysqli_query($dbc,$query) or die ("update user_info error!");
            }
            if($_POST['email']!=''){
              $email=$_POST['email'];
              $query = "UPDATE user_info SET email = '$email' WHERE user_id = '$user_id'";
              $data = mysqli_query($dbc,$query) or die ("update user_info error!");
            }
            if ($data == TRUE) {
              $data = mysqli_query($dbc, $query);
              echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4>Success</h4><strong>Your profile have been updated!</strong></a></div>";
            }
            else{
              echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4>Failed!</h4> <strong>Try again!</strong></a></div>";       
            }
          }

        ?>


        <!-- page body -->
      <form class="form-horizontal">

          <div class="form-group">
            <label class="col-sm-2 control-label">Course ID</label>
            <div class="col-sm-4">
              <p class="form-control-static" id='0'><?php echo $course_id ?></p>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label">Course Name</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="2"><?php echo $row['cname'];?></p>
            </div>
          </div>
           
          <div class="form-group" >
            <label class="col-sm-2 control-label">Department</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="3"><?php echo $row['cdepartment'];?></p>
            </div>
          </div>
           
          <div class="form-group">
            <label class="col-sm-2 control-label">Credit</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="4"><?php echo $row['credit'];?></p>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>
            <div class="col-sm-4">
              <p class="form-control-static" id="4"><?php echo $row['course_intro'];?></p>
            </div>
          </div>   
        <!-- <img src="..." alt="..." class="img-rounded">  -->
      </form>

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