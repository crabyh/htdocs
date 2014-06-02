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

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">

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

          <h1>Add User</h1>
        </div>

        <!-- page body -->
        <div class="row clearfix">

          <div class="col-md-4 column">
          <form role="form" action="change_password.php" method="POST">

            <div class="form-group">
              <label for="OldPassword">Old password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="input_oldpassword" placeholder="Password">
            </div>

            <div class="form-group">
              <label for="NewPassword">New password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="input_newpassword" placeholder="Password">
            </div>

            <div class="form-group">
              <label for="NewPassword">Input new password again</label>
              <input type="password" class="form-control" id="exampleInputPassword1" name="repeat_newpassword" placeholder="Password">
            </div>
            </br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Add</button>
            <button type="submit" class="btn btn-primary" name="reset" value="reset">Reset</button>

          </form>
          </div>
        </div>
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