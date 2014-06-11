<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
$query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
$data = mysqli_query($dbc,$query) or die ("update accounts erroe");
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
          <h1>User Infomation</h1>
        </div>

        <!-- page body -->
        <form class="form-horizontal" role="form">

        <div class="form-group">
          <label class="col-sm-2 control-label">User ID</label>
          <div class="col-sm-4">
            <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['user_id'];?>" disabled>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">User Name</label>
          <div class="col-sm-4">
            <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['username'];?>" disabled>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Department</label>
          <div class="col-sm-4">
            <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['department'];?>" disabled>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Gender</label>
          <div class="col-sm-4">
            <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['gender'];?>" disabled>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Birth Day</label>
          <div class="col-sm-4">
            <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['birthyear']."-".$row['birthmonth']."-".$row['birthday'];?>"disabled>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Enroll time</label>
          <div class="col-sm-4">
            <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $row['enroll_time'];?>" disabled>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Phone</label>
          <div class="col-sm-4">
            <input type="tel" class="form-control" id="inputPassword" value="<?php echo $row["phone"]?>">
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-4">
            <input type="email" class="form-control" id="inputPassword" value="<?php echo $row["email"]?>">
          </div>
        </div>

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