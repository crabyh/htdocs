<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!--CheckUserType-->
<?php 
include 'check_user_type.php';
CheckUserType('manager');
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
          <h2 >Add Course</h2>
        </div>
   <!--  <div class="col-sm-3 page-header" align="right">
          <h2 class="demo-headline" >
            Add</h2>
        </div>
 -->
        <!-- accessing database -->
        <?php
        if(isset($_POST['submit'])){
          $input_oldpassword = $_POST['input_oldpassword'];
          $input_newpassword = $_POST['input_newpassword'];
          $repeat_newpassword = $_POST['repeat_newpassword'];

          if($input_newpassword != $repeat_newpassword){
            echo "new passwords are different!";
          }

          else{
            require_once 'connectvars.php'; 
            $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            $user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
            $query = "SELECT password FROM accounts WHERE user_id = '$user_id'";
            $data = mysqli_query($dbc,$query);
            if(mysqli_num_rows($data)==1){
              $row = mysqli_fetch_array($data);
              $oldpassword = $row['password'];
              $md5_oldpassword = md5("$input_oldpassword");
              echo $md5_oldpassword;
              if($oldpassword == $md5_oldpassword){
                $md5_newpassword = md5("$input_newpassword");
                $user_id = $_SESSION['user_id'];
                $query = "UPDATE accounts SET password = '$md5_newpassword' WHERE user_id = '$user_id'";
                $data = mysqli_query($dbc,$query) or die ("update accounts failed!");
              }
            }
          }
        }
        ?>

        <!-- page body -->
        <div class="row clearfix"> 
          <div class="col-md-5 column">
            <form class="form" id='9'>
              
              <div class="form-group">
                <label>Course ID</label>
                <input type="text" class="form-control" name="user_id" placeholder="">
              </div>
              
              <div class="form-group">
                <label>Course Name</label>
                <input type="text" class="form-control" name="user_id" placeholder="">
              </div>

              <div class="form-group">
                <label>Department</label>
                <input type="text" class="form-control" name="user_id" placeholder="">
              </div>

              <div class="form-group">
                <label>Credit</label>
                <input type="text" class="form-control" name="user_id" placeholder="">
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea type="text" class="form-control" name="description" rows="5"> </textarea>
              </div>

              <br>

              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="reset" value="submit">Submit</button>
                <button type="submit" class="btn btn-default" name="reset" value="reset">Reset</button>
              </div>

            </form>
          </div>
        </div>

      </div><!-- container -->
    </div>
      <!-- </div>
    </div>
 -->

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>