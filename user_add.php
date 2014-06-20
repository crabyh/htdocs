<?php session_start();?>
<!DOCTYPE HTML>
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
<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<body>
    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- Begin page content -->
      <div class="container">
        <!-- success Modal -->
          <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="successModalLabel">Success</h4>
                </div>
                <div class="modal-body">
                  You have deleted course successfully!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="myModalLabel">Upload Icon</h4>
                </div><!-- 里面的内容 -->

                <div class="modal-body">
                  <p>Choose a picture from your computer to upload as your icon.<br />
                  Pay attention that you could only upload <b>jpg</b> file ,and the size of your file couldn't be lager than <b>20kb</b> and <b>140x140</b>.<br /><br /></p>
                  <form method="POST" action="user_info.php" enctype="multipart/form-data">
                    <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
                    <input type="file" name="file" id="file"/><br />
                    <input class="btn btn-primary" type="submit" value="Upload" /></p>
                  </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <!-- Fail Modal -->
          <div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="failModalLabel">Failed</h4>
                </div>
                <div class="modal-body">
                  Delete falied! Please try agian!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        <div class="page-header">
          <h1>Add User
          </h1>
        </div>

        <!-- accessing database not completed -->
        <?php
          if(isset($_POST['submit']))
          {
            $input_newpassword = $_POST['input_newpassword'];
            $repeat_newpassword = $_POST['repeat_newpassword'];
            // echo $input_newpassword." ".$repeat_newpassword;
            if($input_newpassword != $repeat_newpassword)
            {
              echo'<div class="alert alert-danger alert-dismissable">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4>
                         The two passwords are different!
                      </h4> <strong>Please check your password and try again.</strong></a>
                    </div>';

            }
            else 

            {
                require_once 'connectvars.php'; 
                $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                $u_id=$_POST['u_id']; 
                $u_name=$_POST['u_name'];
                $typ=$_POST['typ'];
                $gender=$_POST['gender'];
                $department=$_POST['department'];
                $enroll_time=$_POST['enroll_time'];
                $birthday=$_POST['birthday'];
                $email=$_POST['email'];
                $phone=$_POST['phone'];
                $query = "SELECT * FROM accounts WHERE user_id = '$u_id';";
                $data = mysqli_query($dbc,$query);
                if(mysqli_num_rows($data)==1)
                {
                  echo'<div class="alert alert-danger alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4>
                          This User '.$u_id.' is already existed!
                        </h4> <strong>Please try another one.</strong>
                      </div>';
                }
                else
                {
                    $md5_newpassword = md5("$input_newpassword");
                    $user_id = $_SESSION['user_id'];
                    $query = "INSERT INTO accounts VALUES('$u_id','$md5_newpassword','$typ');";
                    $data = mysqli_query($dbc,$query);

                    $query = "INSERT INTO user_info VALUES('$u_id','$u_name','$department','$gender',date('$birthday'),'$enroll_time','$phone','$email');";
                    $data = mysqli_query($dbc,$query);
                    echo'<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4>
                            Adding user success!
                          </h4>
                          <p>User ID: '.$u_id.'</p>
                          <p>User Name: '.$u_name.'</p>
                          <p>User Type: '.$typ.'</p>
                          <p>Gender: '.$gender.'</p>
                          <p>Department: '.$department.'</p>
                          <p>Enroll Time: '.$enroll_time.'</p>
                          <p>Birthday: '.$birthday.'</p>
                          <p>Email: '.$email.'</p>
                          <p>Phone: '.$phone.'</p>
                        </div>';
                    // if(mysqli_num_rows($data)==1)
                    // {
                    //   echo'<script type="text/javascript"> 
                    //    setTimeout(window.location.href="loged.php?passw_ch=success",3); 
                    //    </script>';
                    // }
                    // else
                    // {
                    //   // echo mysqli_errno($dbc)." ".mysqli_error($dbc);

                    //   echo'<script type="text/javascript"> 
                    //      setTimeout(window.location.href="loged.php?passw_ch=success",3); 
                    //     </script>';}
                }
            }




          }
        ?>
        <!-- page body -->
        <div class="row clearfix"> 
          <div class="col-md-5 column">
            <form class="form" id='9' method="POST" action="user_add.php">
              
              <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control" name="u_id" placeholder="">
              </div>

              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="input_newpassword" placeholder="Password" required>
              </div>

              <div class="form-group">
                <label for="NewPassword">Confirm your password again</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="repeat_newpassword" placeholder="Password" required>
              </div>

              <div class="form-group">
                <label>User Name</label>
                <input type="text" class="form-control" name="u_name" placeholder="">
              </div>

              <div class="form-group">
              <label>User Type</label><br/>
                <select name="typ" id="seltype" class="form-control">
                  <option value="student">Student</option>
                  <option value="teacher">Teacher</option>
                  <option value="manager">Manager</option>
                  <?php if ($_SESSION['usertype'] == "admin") { ?>
                  <option value="admin">Administration</option>
                  <?php } ?>
                </select>
              </div>

              <div class="form-group">
              <label>Gender</label><br/>
                <select name="gender" id="seltype" class="form-control">
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>

              <div class="form-group">
                <label>Department</label>
                <input type="text" class="form-control" name="department" placeholder="">
              </div>

              <div class="form-group">
                <label>Enroll Year</label>
                <input type="number" class="form-control" name="enroll_time" value="2014">
              </div>

              <div class='form-group' >
                <label class='control-label'>Birth Day</label>
                <input type="date" class="form-control" name="birthday" value="">
              </div>

              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="">
              </div>

              <div class="form-group">
                <label>Phone</label>
                <input type="tel" class="form-control" data-format="ddd-dddd-dddd" name="phone" placeholder="">
              </div>

              <br>
              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button type="reset" class="btn" name="reset" value="reset">Reset</button>
              </div>
              <br>

            </form>
          </div>
        </div>

      </div><!-- container -->
    </div>

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="./js/bootstrap-datetimepicker.uk.js" charset="UTF-8"></script>
    <script type="text/javascript">
    
  $('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
    });
</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>