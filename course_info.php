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
$query = "SELECT * FROM course_info WHERE cid='$course_id'";
$data = mysqli_query($dbc,$query);
if(mysqli_num_rows($data)==1)
  $row = mysqli_fetch_array($data);
?>
        
<!-- include head file-->
<head>
<?php include 'header.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
  $("#editBTN").click(function(){
    $("#former").hide();
    $("#latter").show();
    $(this).hide();
  });

  $("#submitBTN").click(function(event){
    event.preventDefault();
    var cid = $("#cid").val();
    var cname = $("#cname").val();
    var cdept = $("#cdept").val();
    var credit = $("#credit").val();
    var cintro = $("#cintro").val();
    $.ajax({
      type: "POST",
      url: "course_info_php.php",
      data: "cid="+ cid + "&cname=" + cname + "&cdept=" + cdept + "&credit=" + credit + "&cintro=" + cintro,
      success: function(){
        $("#p_cid").text(cid);
        $("#p_cname").text(cname);
        $("#p_cdept").text(cdept);
        $("#p_credit").text(credit);
        $("#p_cintro").text(cintro);
        $("#latter").hide();
        $("#former").show();
        $("#editBTN").show();
        $("#success").show();
      },
      error: function(){
        $("#fail").show();
      }
    });
  });

  $("#resetBTN").click(function(event){
    event.preventDefault();
    var cid = $("#cid").val();
    $.ajax({
      type: "GET",
      url: "course_info_php.php",
      data: "cid=" + cid,
      dataType: "json",
      success: function(data){
        var cname = data[0][1];
        var cdept = data[0][2];
        var credit = data[0][3];
        var cintro = data[0][4];
        $("#cname").val(cname);
        $("#cdept").val(cdept);
        $("#credit").val(credit);
        $("#cintro").val(cintro);
      }
    })
  })

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
          <h1>Course Infomation <small>
            <button class="btn btn-default" id="editBTN">Edit</button></small>
          </h1>
        </div>

        <!-- 成功提示 -->
        <div class='alert alert-success alert-dismissable' style="display: none" id="success">
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
          <h4>Success</h4>
          <strong>Course information have been updated!</strong></a>
        </div>

        <!-- 失败提示 -->
        <div class='alert alert-warning alert-dismissable' style="display: none" id="fail">
          <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
          <h4>Fail!</h4>
          <strong>Please try again!</strong></a>
        </div>
        
        <!-- page body -->
        <form class="form-horizontal" id="former">

            <div class="form-group">
              <label class="col-sm-2 control-label">Course ID</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="p_cid"><?php echo $course_id ?></p>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Course Name</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="p_cname"><?php echo $row['cname'];?></p>
              </div>
            </div>
             
            <div class="form-group" >
              <label class="col-sm-2 control-label">Department</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="p_cdept"><?php echo $row['cdepartment'];?></p>
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-sm-2 control-label">Credit</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="p_credit"><?php echo $row['credit'];?></p>
              </div>
            </div>
            
            <div class="form-group">
              <label class="col-sm-2 control-label">Description</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="p_cintro"><?php echo $row['course_intro'];?></p>
              </div>
            </div>   
          <!-- <img src="..." alt="..." class="img-rounded">  -->
        </form>

        <form class="form-horizontal" id="latter" style="display: none">
          <div class="col-sm-4">

            <div class="form-group">
              <label class="control-label">Course ID</label>
              <input class="form-control" value="<?php echo $course_id ?>" id="cid" disabled>
            </div>
            
            <div class="form-group">
              <label class="control-label">Course Name</label>
              <input class="form-control" id="cname" value="<?php echo $row['cname'];?>">
            </div>
             
            <div class="form-group" >
              <label class="control-label">Department</label>
              <input class="form-control" id="cdept" value="<?php echo $row['cdepartment'];?>">
            </div>
             
            <div class="form-group">
              <label class="control-label">Credit</label>
              <input class="form-control" id="credit" value="<?php echo $row['credit'];?>">
            </div>
            
            <div class="form-group">
              <label class="control-label">Description</label>
                <textarea  class="form-control" rows="4" id="cintro"><?php echo $row['course_intro'];?></textarea>
            </div>   
          <!-- <img src="..." alt="..." class="img-rounded">  -->

            <div class="form-group">
              <button class="btn btn-primary" type="submit" name="submit" value="submit" id="submitBTN">Submit</button>
              <input class="btn btn-default" type="button" name="reset" value="reset" id="resetBTN">
            </div>

          </div> <!-- col-sm-4 -->
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