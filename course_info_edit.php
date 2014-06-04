<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php //include 'check_access.php'; ?>

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$course_id="00001";         //$_GET['course_id'];
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
          <h1>Course Infomation 
            <!--button class="btn btn-default" id="1">Edit</button-->
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
            <input type="email" class="form-control" id="inputPassword" placeholder="<?php echo $course_id ?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Course Name</label>
          <div class="col-sm-4">
            <input type="email" class="form-control" id="inputPassword" placeholder="<?php echo $row['cname'];?>">
          </div>
        </div>
         
        <div class="form-group" >
          <label class="col-sm-2 control-label">Department</label>
          <div class="col-sm-4">
            <input type="email" class="form-control" id="inputPassword" placeholder="<?php echo $row['cdepartment'];?>">
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Credit</label>
          <div class="col-sm-4">
            <input type="email" class="form-control" id="inputPassword" placeholder="<?php echo $row['credit'];?>">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Description</label>
          <div class="col-sm-4">
            <input type="email" class="form-control" id="inputPassword" placeholder="<?php echo $row['course_intro'];?>">
          </div>
        </div>   
        <!-- <img src="..." alt="..." class="img-rounded">  -->

        <div class="form-group">
          <div class="col-sm-2">
          </div>
          <div class="col-sm-6">
            <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
            <input class="btn btn-default" type="button" name="reset" value="reset">
          </div>
        </div>

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