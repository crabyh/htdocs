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

      <!--CheckUserType-->
      <?php 
      include 'check_user_type.php';
      CheckUserType('manager');
      ?> 

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>Add User
          </h1>
        </div>

        <!-- accessing database not completed -->
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
                <label>User ID</label>
                <input type="text" class="form-control" name="user_id" placeholder="">
              </div>

              <div class="form-group">
                <label>User Name</label>
                <input type="text" class="form-control" name="user_id" placeholder="">
              </div>

              <div class="form-group">
              <label>User Type</label><br/>
                <select name="seltype" id="seltype" class="form-control">
                  <option value="student">Student</option>
                  <option value="teacher">Teacher</option>
                  <option value="manager">Manager</option>
                  <option value="admin">Admin</option>
                </select>
              </div>

              <div class="form-group">
              <label>Gender</label><br/>
                <select name="seltype" id="seltype" class="form-control">
                  <option value="M">Man</option>
                  <option value="F">Woman</option>
                </select>
              </div>

              <div class="form-group">
                <label>Department</label>
                <input type="text" class="form-control" name="user_id" placeholder="">
              </div>

              <div class="form-group">
                <label>Enroll Year</label>
                <input type="number" class="form-control" name="user_id" value="2014">
              </div>

              <div class="form-group">
                <label>birthday</label>
                <input type="date" class="form-control" name="user_id" placeholder="">
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

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>