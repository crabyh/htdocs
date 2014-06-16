<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
if (isset($_GET['user_id'])) {
  if ($_SESSION['usertype'] == 'manager' || $_SESSION['usertype'] == 'admin') { //如果是manager或者admin访问的话
    $user_id = $_GET['user_id']; // 如果有get的话，覆盖掉自己的；
  }
  else {
    echo'<script type="text/javascript"> 
    setTimeout(window.location.href="index.php?access=illegal",3); 
    </script>';
  }
}
$query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
$data = mysqli_query($dbc,$query);
if(mysqli_num_rows($data)==1){
  $row = mysqli_fetch_array($data);
}
?>
    
<!--New a storage-->
<?php
//$storage = new SaeStorage();
?>


<!-- include head file-->
<head>
<?php include 'header.php'; ?>
<script type="text/javascript" src="js/user.js"></script>
</head>

<body>

    <!-- Wrap all page content here -->
  <div id="wrap">

    <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header" id="page-header">
        <h1> User Infomation 
          <small>
            <button class="btn btn-sm btn-default" id='editBTN'>Edit</button>
          </small>
        </h1>

        <!--上传头像的php部分 by 女王-->
        <?php 
        if(isset($_FILES["file"]))
        {
          if ((
              ($_FILES["file"]["type"] == "image/jpeg") 
              || ($_FILES["file"]["type"] == "image/pjpeg"))
              && ($_FILES["file"]["size"] < 2000000))
          {
            if ($_FILES["file"]["error"] > 0)
            {
              echo '<script type="text/javascript">$(document).ready(function(){ $("#fail").show(); })</script>';
            }
            else
            { //online upload file
              $domain = 'uploadicon';
              $destFileName = md5($_SESSION['user_id']) . ".jpg";
              $srcFileName = $_FILES["file"]["tmp_name"];
              $result = $storage->upload($domain,$destFileName,$srcFileName);
              //online upload file end
              //$iconname = md5($_SESSION['user_id']) . ".jpg";
              //move_uploaded_file($_FILES["file"]["tmp_name"],"uploadicon/" . $iconname);
              if(!$result)
                  echo '<script type="text/javascript">$(document).ready(function(){ $("#fail").show(); })</script>';
              else
                  echo '<script type="text/javascript">$(document).ready(function(){ $("#success").show(); })</script>';    
            }
          }
            else
              echo '<script type="text/javascript">$(document).ready(function(){ $("#fail").show(); })</script>';
        }
        ?>

          
        <!-- Modal -->
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
                  <input class="btn btn-primary" type="submit" value="Upload" id="uploadInModal"/></p>
                </form>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
      </div> <!-- end page-header -->

      <!-- success prompt -->
      <div class='alert alert-success alert-dismissable' style="display:none" id="success">
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4>Success</h4>
        <strong>Your profile have been updated!</strong></a>
      </div>

      <!-- failed prompt -->
      <div class='alert alert-warning alert-dismissable' style="display:none" id="fail">
        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
        <h4>Failed!</h4> 
        <strong>Try again!</strong></a>
      </div>

      <!-- page body -->
      <!-- former table used to display info of user -->

        <form class="form-horizontal" id='former'>
          <div class="col-md-5">

              <div class="form-group" >
                <label class="col-md-4 control-label">User ID</label>
                <div class="col-md-6">
                  <p class="form-control-static"><?php echo $row['user_id'];?></p>
                </div>
              </div>
              
              <div class="form-group">
                <label class="col-md-4 control-label">User Name</label>
                <div class="col-md-6">
                  <p class="form-control-static"><?php echo $row['username'];?></p>
                </div>
              </div>
               
              <div class="form-group" >
                <label class="col-md-4 control-label">Department</label>
                <div class="col-md-6">
                  <p class="form-control-static"><?php echo $row['department'];?></p>
                </div>
              </div>
               
              <div class="form-group">
                <label class="col-md-4 control-label">Gender</label>
                <div class="col-md-6">
                  <p class="form-control-static"><?php echo $row['gender'];?></p>
                </div>
              </div>
               
              <div class="form-group">
                <label class="col-md-4 control-label">Birth Day</label>
                <div class="col-md-6">
                  <p class="form-control-static"><?php echo $row['birthday'];?></p>
                </div>
              </div>
               
              <div class="form-group">
                <label class="col-md-4 control-label">Enroll time</label>
                <div class="col-md-6">
                  <p class="form-control-static"><?php echo $row['enroll_time'];?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Phone</label>
                <div class="col-md-6">
                  <p class="form-control-static" id="phone_label"><?php echo $row['phone'];?></p>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-4 control-label">Email</label>
                <div class="col-md-6">
                  <p class="form-control-static" id="email_label"><?php echo $row['email'];?></p>
                </div>
              </div>

            </div>
        </form>

        <!-- latter form used to edit info -->
        <form role='form' class='form-horizontal' id='latter' style="display: none">
          <div class="col-md-5">

            <div class='form-group' >
              <label class='control-label'>User ID</label>
              <input class='form-control' type='text' value='<?php echo $row['user_id'];?>' id="user_id" disabled>
            </div>

            <div class='form-group' >
              <label class='control-label'>User Type</label>
              <select name="seltype" id="seltype" class="form-control admin" disabled>
                <option value="student">Student</option>
                <option value="teacher">Teacher</option>
                <option value="manager">Manager</option>
                <option value="admin">Administration</option>
              </select>
            </div>

            <div class='form-group' >
              <label class='control-label'>User Name</label>
              <input class='form-control admin manager' type='text' value='<?php echo $row['username'];?>' disabled>
            </div>

            <div class='form-group' >
              <label class='ontrol-label'>Department</label>
              <input class='form-control admin manager' type='text' value='<?php echo $row['department'];?>' disabled>
            </div>

            <div class='form-group' >
              <label class='control-label'>Gender</label>
              <select name="seltype" id="seltype" class="form-control admin manager" disabled>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>

            <div class='form-group' >
              <label class='control-label'>Birth Day</label>
              <input type="date" class="form-control admin manager" name="birthday" value="<?php echo $row['birthday'];?>" disabled>
            </div>

            <div class='form-group' >
              <label class='control-label'>Enroll Time</label>
              <input class='form-control admin manager' type='number' value='<?php echo $row['enroll_time'];?>' disabled>
            </div>

            <div class='form-group'>
              <label class='control-label'>Phone</label>
              <input type='tel' class='form-control' name='phone' id='phonenum' value='<?php echo $row['phone']?>'>
            </div>

            <div class='form-group'>
              <label class='control-label'>Email</label>
              <input type='email' name='email' class='form-control' id='emailaddr' value='<?php echo $row['email']?>'>
            </div>

            <div class='form-group'>
              <label class='control-label'></label>
              <button class='btn btn-primary' name='submit' type='submit' value='Done' id='doneBTN'>Done</button>
              <input class="btn btn-default" type="button" name="reset" value="reset" id="resetBTN">
            </div>
          </div>

        </form>

      <!--即显示头像的语句-->
      <div class="col-md-4">
        <br />
        <div class="form-group" align="center"> 
		    <?php
        $domain = 'uploadicon';
			  $iconname = md5($_SESSION['user_id']).".jpg";
    			//if($storage->fileExists($domain,$iconname))
    			//	echo '<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="140x140" src="http://esst1-uploadicon.stor.sinaapp.com/'. $iconname . '">';
          //else
          //  echo '<img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="140x140" src="http://esst1-uploadicon.stor.sinaapp.com/default.jpg">';
    		?>

  		</div> <!-- end显示头像的4块 --> <!-- 本地显示图片代码：将 http://esst1-uploadicon.stor.sinaapp.com/替换为uploadicon/-->
        <div class="form-group" align="center">
          <button class="btn btn-sm btn-default" id='upload' data-toggle="modal" data-target="#myModal" style="display: none">UploadIcon</button> 
        </div>
      </div>

    </div> <!-- end container -->
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