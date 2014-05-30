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
<!--
<script type="text/javascript">
function createXmlHttp() {  
    var xmlHttp = null;  
    try {  
        //Firefox, Opera 8.0+, Safari  
        xmlHttp = new XMLHttpRequest();  
    } catch (e) {  
        //IE  
        try {  
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");  
        } catch (e) {  
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");  
        }  
    }  
    return xmlHttp;  
}

function submitForm() {  
    var xmlHttp = createXmlHttp();  
    if(!xmlHttp) {  
        alert("您的浏览器不支持AJAX！");  
        return 0;  
    }  
    var url = 'user_info.php';  
    var postData = "";  
    postData = "phone=" + document.getElementById('phonenum').value + "email=" + document.getElementById('emailaddr').value;  
    postData += "t=" + Math.random();  
      
    xmlHttp.open("POST", url, true);  
    xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  
    xmlHttp.onreadystatechange = function() {  
        if(xmlHttp.readyState == 4 && xmlHttp.status == 200) {  
            if(xmlHttp.responseText == '1') {  
                alert('post successed');  
            }  
        }  
    }  
    xmlHttp.send(postData);  
}  
</script>
-->
<!-- include head file-->
<head>
<?php include 'header.php'; ?>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("button").click(function(){
    $("form#9").replaceWith("<form role='form' action='' method='post' class='form-horizontal'><div class='form-group' ><label class='col-sm-2 control-label'>User ID</label><div class='col-sm-4'><input class='form-control' id='disabledInput' type='text' placeholder='<?php echo $_SESSION['user_id'];?>' disabled></div></div><div class='form-group' ><label class='col-sm-2 control-label'>User Name</label><div class='col-sm-4'><input class='form-control' id='disabledInput' type='text' placeholder='<?php echo $_SESSION['username'];?>' disabled></div></div><div class='form-group' ><label class='col-sm-2 control-label'>Enroll Time</label><div class='col-sm-4'><input class='form-control' id='disabledInput' type='text' placeholder='<?php echo $_SESSION['department'];?>' disabled></div></div><div class='form-group' ><label class='col-sm-2 control-label'>Department</label><div class='col-sm-4'><input class='form-control' id='disabledInput' type='text' placeholder='<?php echo $_SESSION['gender'];?>' disabled></div></div><div class='form-group' ><label class='col-sm-2 control-label'>Gender</label><div class='col-sm-4'><input class='form-control' id='disabledInput' type='text' placeholder='<?php echo $_SESSION['birthyear'].'-'.$_SESSION['birthmonth'].'-'.$_SESSION['birthday'];?>'disabled></div></div><div class='form-group' ><label class='col-sm-2 control-label'>Birth Day</label><div class='col-sm-4'><input class='form-control' id='disabledInput' type='text' placeholder='<?php echo $_SESSION['enroll_time'];?>' disabled></div></div><div class='form-group'><label class='col-sm-2 control-label'>Phone</label><div class='col-sm-4'><input type='tel' class='form-control' name='phone' id='phonenum' placeholder='<?php echo $_SESSION['phone']?>'></div></div><div class='form-group'><label class='col-sm-2 control-label'>Email</label><div class='col-sm-4'><input type='email' name='email' class='form-control' id='emailaddr' placeholder='<?php echo $_SESSION['email']?>'></div></div><div class='form-group'><label class='col-sm-5 control-label'></label><input class='btn btn-primary' name='submit' type='submit' value='Done' onclick='refresh()'></div></form>")
    $("button#1").replaceWith("")
  });
});
</script>
</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>User Infomation <small><button class="btn btn-default" id='1'>Edit</button></small></h1>
        </div>

        <!-- 用来与数据库交互 -->
        <?php
          if(isset($_POST['submit'])){
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
              echo "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true' action='user_info.php'>×</button><h4>Success</h4><strong>Your profile have been updated!</strong></a></div>";
            }
            else{
              echo "<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true' action='user_info.php'>×</button><h4>Failed!</h4> <strong>Try again!</strong></a></div>";            // die ("Failed!");
            }
          }

        ?>
        <!-- page body -->
        <form class="form-horizontal" id='9'>

        <div class="form-group" >
          <label class="col-sm-2 control-label">User ID</label>
          <div class="col-sm-4">
            <p class="form-control-static" id='0'><?php echo $_SESSION['user_id'];?></p>
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-2 control-label">User Name</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="2"><?php echo $_SESSION['username'];?></p>
          </div>
        </div>
         
        <div class="form-group" >
          <label class="col-sm-2 control-label">Department</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="3"><?php echo $_SESSION['department'];?></p>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Gender</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="4"><?php echo $_SESSION['gender'];?></p>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Birth Day</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="5"><?php echo $_SESSION['birthyear']."-".$_SESSION['birthmonth']."-".$_SESSION['birthday'];?></p>
          </div>
        </div>
         
        <div class="form-group">
          <label class="col-sm-2 control-label">Enroll time</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="6"><?php echo $_SESSION['enroll_time'];?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Phone</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="7"><?php echo $_SESSION['phone'];?></p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">Email</label>
          <div class="col-sm-4">
            <p class="form-control-static" id="8"><?php echo $_SESSION['email'];?></p>
          </div>
        </div>
      </form>

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