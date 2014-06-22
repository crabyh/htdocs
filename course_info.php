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
$query = "SELECT * FROM course_info NATURAL JOIN class_info WHERE course_info.cid='$course_id'";
$teacherQuery = "SELECT user_id, username, quantity FROM class_info NATURAL JOIN user_info WHERE class_info.cid = '$course_id'";
$data = mysqli_query($dbc, $query);
$teacherData = mysqli_query($dbc, $teacherQuery);
if($data) {
  $row = mysqli_fetch_array($data);
}
?>
        
<!-- include head file-->
<head>
  <?php include 'header.php'; ?>
  <script type="text/javascript" src="js/course.js"></script>
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
              <label class="col-sm-2 control-label">Course Hour</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="p_c_hour"><?php echo $row['c_hour'];?></p>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Description</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="p_cintro"><?php echo $row['course_intro'];?></p>
              </div>
            </div>    

            <div class="form-group">
              <label class="col-sm-2 control-label">Teacher</label>
              <div class="col-sm-4">
                <p class="form-control-static" id="teacher">
                  <?php 
                    while ($teacherArray = mysqli_fetch_array($teacherData)) {
                      echo $teacherArray['username']." ".$teacherArray['user_id'];
                      $teacherResult[] = $teacherArray['username'];
                      $quantityResult[] = $teacherArray['quantity'];
                      echo "<br />";
                    }
                  ?>
                </p>
              </div>
            </div> 
        </form>

        <div class="row clearfix">
          <form class="form" id="latter" style="display: none">
            <div class="col-md-6 column">

              <div class="form-group">
                <label class="control-label">Course ID</label>
                <input class="form-control" value="<?php echo $course_id ?>" id="cid" maxlength="20" disabled>
              </div>
              
              <div class="form-group">
                <label class="control-label">Course Name</label>
                <input class="form-control" id="cname" value="<?php echo $row['cname'];?>" maxlength="60">
              </div>
               
              <div class="form-group" >
                <label class="control-label">Department</label>
                <input class="form-control" id="cdept" value="<?php echo $row['cdepartment'];?>" maxlength="40">
              </div>
               
              <div class="form-group">
                <label>Credit</label>
                <select name="credit" id="" class="form-control">
                  <option value="0.5">0.5</option>
                  <option value="1">1</option>
                  <option value="1.5">1.5</option>
                  <option value="2">2</option>
                  <option value="2.5">2.5</option>
                  <option value="3">3</option>
                  <option value="3.5">3.5</option>
                  <option value="4">4</option>
                  <option value="4.5">4.5</option>
                  <option value="5">5</option>
                  <option value="5.5">5.5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>

              <div class="form-group">
                <label>Course Hours</label>
                <select name="c_hour" id="" class="form-control">
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>  
              
              <div class="form-group">
                <label class="control-label">Description</label>
                  <textarea  class="form-control" rows="4" id="cintro" maxlength="2000"><?php echo $row['course_intro'];?></textarea>
              </div>   

              <br>
              <div class="form-group">
                <button class="btn btn-primary" type="submit" name="submit" value="submit" id="submitBTN">Submit</button>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn" type="button" name="reset" value="reset" id="resetBTN">Reset</button>
                <br>
              </div>

            </div> <!-- col-md-6 -->

            <div class="col-md-6 column">
              <?php if ($teacherNum = count($teacherResult)) { 
                echo '<div class="row">';
                for ($i=0; $i < $teacherNum; $i++){ 
                  echo '
                    <div class="form-group col-md-6">
                      <label>Teacher Name</label>
                      <input type="text" class="form-control" name="teacher[]" id="teacher'.$i.'" value="'.$teacherResult[$i].'" maxlength="20" disabled>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Capacity</label>
                      <input type="text" class="form-control" name="quantity[]" id="quantity'.$i.'" value="'.$quantityResult[$i].'" disabled>
                    </div>';
                } //end for
                echo '
                  </div> <!-- end row -->
                  </div> <!-- 右边的框 -->';
                } //end if
              ?>
            </div>

          </form>
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