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
          <h1>Course Infomation <small>
            <button class="btn btn-default" id="1">Edit</button></small>
          </h1>
        </div>
        
        <?php
           $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
           $query2="SELECT * FROM course_info WHERE cid='$course_id'";
           $data2=mysqli_query($dbc,$query2);
           if(mysqli_num_rows($data2))
           {
              $row2 = mysqli_fetch_array($data2);
              $_SESSION['cname'] = $row2['cname'];
              $_SESSION['cdepartment'] = $row2['cdeparment'];
              $_SESSION['credit'] = $row2['credit'];
              $_SESSION['course_intro'] = $row2['course_intro'];   
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
            <p class="form-control-static" id="2"><?php echo $_SESSION['cname'];?></p>
          </div>
        </div>
         
        <div class="form-group" >
          <label class="col-sm-2 control-label">Department</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="3"><?php echo $_SESSION['cdepartment'];?></p>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Credit</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="4"><?php echo $_SESSION['credit'];?></p>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Description</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="4"><?php echo $_SESSION['course_intro'];?></p>
          </div>
        </div>   
        <!-- <img src="..." alt="..." class="img-rounded">  -->
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