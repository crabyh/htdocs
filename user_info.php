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
$data = mysqli_query($dbc,$query);
if(mysqli_num_rows($data)==1){
  $row = mysqli_fetch_array($data);
}
?>

<!--上传头像的php部分 by 女王-->
<?php 
if(isset($_FILES["file"]))
{
  if ((//($_FILES["file"]["type"] == "image/png")||
     ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/pjpeg")
  )
  && ($_FILES["file"]["size"] < 2000000))
    {
    if ($_FILES["file"]["error"] > 0)
      {
      echo "Error: " . $_FILES["file"]["error"] . "<br />";//上传错误
      }
    else
      {
      $iconname = md5($_SESSION['user_id']) . ".jpg";
      move_uploaded_file($_FILES["file"]["tmp_name"],"uploadicon/" . $iconname);
      echo "Stored in: " . "uploadicon/" . $iconname;          
      }
    }
    else
      echo "file type or size wrong.";
}
?>


<!-- include head file-->
<head>
<?php include 'header.php'; ?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("button#editBTN").click(function(){
      $("form#former").hide();
      $("form#latter").show();
      $("button#editBTN").hide();
    });
    $("button#doneBTN").click(function(event){
      event.preventDefault();
      var newphone = $("input#phonenum").val();
      var newemail = $("input#emailaddr").val(); 
      $.ajax({
        type: "POST",
        url:"user_info.php",
        data: "phone=" + newphone + "&email=" + newemail,  
        success: function(){
          $('#phone_label').text(newphone);
          $('#email_label').text(newemail);
          $("form#former").show();
          $("form#latter").hide();
          $("#success").show();
          $("#editBTN").show();
        },
        error: function(){
          $("#fail").show()
        }
      }); // end ajax
    }); //end click
}); //end ready function
</script>
</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header" id="page-header">
          <h1 class=value>User Infomation <button class="btn btn-sm btn-default" id='editBTN'>Edit</button>
          <button class="btn btn-sm btn-default" id='uploadicon' data-toggle="modal" data-target="#myModal">UploadIcon</button></h1>     <!-- data-tog 到myModal均为下拉菜单的代码部分-->    
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
                    <input class="btn btn-primary" type="submit" value="Upload" /></p>
                  </form>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>

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

        <!-- 用来与数据库交互 --> <!-- 因为上传文件的提交方式也是post，所以我在下面的if判断句中加了一个判断条件isset($_POST['phone']) by女王 -->
        <?php
          if($_SERVER['REQUEST_METHOD']=="POST" and isset($_POST['phone'])){ 
            $data = FALSE;
            if($_POST['phone']!=''){
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
              echo "success";
            }
            else{
              echo "fail";       
            }
          }
        ?>

        <!-- page body -->
        <!-- former table used to display info of user -->
        <!-- 前端显示的class原来为col-sm-格式，被我统一调整成了col-md-4格式。同时添加进了row featurette，允许头像与个人信息并排显示。by女王 -->
    <form class="form-horizontal" id='former'>
      <div class="row featurette">
       <div class="col-md-6">

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
              <p class="form-control-static"><?php echo $row['birthyear']."-".$row['birthmonth']."-".$row['birthday'];?></p>
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
        </form>
      </div>
      <!--即显示头像的语句-->
<<<<<<< HEAD
      <div class="col-md-4">
        <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="140x140" src="uploadicon/<?php echo md5($_SESSION['user_id']);?>.jpg">
=======
      <div class="col-md-6">
        <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="140x140" src="uploadicon/<?php echo$_SESSION['user_id'];?>.jpg">
>>>>>>> FETCH_HEAD
      </div>
    </div>

        <!-- latter form used to edit info -->
    <form role='form' method='post' class='form-horizontal' id='latter' style="display: none">
      <div class="col-md-4">

          <div class='form-group' >
            <label class='control-label'>User ID</label>
            <input class='form-control' type='text' value='<?php echo $row['user_id'];?>'>
          </div>

          <div class='form-group' >
            <label class='control-label'>User Type</label>
            <select name="seltype" id="seltype" class="form-control">
              <option value="student">Student</option>
              <option value="teacher">Teacher</option>
              <option value="manager">Manager</option>
              <option value="admin">Administration</option>
            </select>
          </div>

          <div class='form-group' >
            <label class='control-label'>User Name</label>
            <input class='form-control' type='text' value='<?php echo $row['username'];?>'>
          </div>

          <div class='form-group' >
            <label class='ontrol-label'>Department</label>
            <input class='form-control' type='text' value='<?php echo $row['department'];?>'>
          </div>

          <div class='form-group' >
            <label class='control-label'>Gender</label>
            <select name="seltype" id="seltype" class="form-control">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

          <div class='form-group' >
            <label class='control-label'>Birth Day</label>
            <input type="date" class="form-control" name="user_id" value="<?php echo $row['birthyear'].'-'.$row['birthmonth'].'-'.$row['birthday'];?>">
          </div>

          <div class='form-group' >
            <label class='control-label'>Enroll Time</label>
            <input class='form-control' type='number' value='<?php echo $row['enroll_time'];?>'>
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
            <input class="btn btn-default" type="button" name="reset" value="reset">
          </div>
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