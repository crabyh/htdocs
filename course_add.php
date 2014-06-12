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

        <!-- accessing database not completed -->
        <?php
        if(isset($_POST['submit'])){
          $cid = $_POST['cid'];
          $cname = $_POST['cname'];
          $cdepartment = $_POST['cdepartment'];
          $credit = $_POST['credit'];          
          require_once 'connectvars.php'; 
          $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
          $query = "SELECT * FROM course_info WHERE cid = '$cid'";
          $data = mysqli_query($dbc,$query);
          if(mysqli_num_rows($data)==1)
            echo'<div class="alert alert-danger alert-dismissable">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>
                      This cid '.$cid.' is already existed!
                    </h4> <strong>Please try another one.</strong>
                  </div>';
          else{
            $query = "INSERT INTO course_info (cid, cname, cdepartment, credit) VALUES ('$cid', '$cname', '$cdepartment', $credit)";
            $data = mysqli_query($dbc,$query) or die ("update accounts failed!");
            if(isset($_POST['course_intro'])){
              $course_intro = $_POST['course_intro'];
              $query = "UPDATE course_info SET course_intro = '$course_intro' WHERE cid = '$cid'";
              $data = mysqli_query($dbc,$query) or die ("update accounts failed!");
              echo'<div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4>
                        Adding course success!
                      </h4>
                      <p>Course ID: '.$cid.'</p>
                      <p>Course Name: '.$cname.'</p>
                      <p>Department: '.$cdepartment.'</p>
                      <p>Credit: '.$credit.'</p>
                    </div>';
            }
          }
        }
        ?>

          <h2 >Add Course</h2>
        </div>

        <!-- page body -->
        <div class="row clearfix"> 
          <div class="col-md-5 column">
            <form class="form" method="post" id='9'>
              
              <div class="form-group">
                <label>Course ID</label>
                <input type="text" class="form-control" name="cid" placeholder="">
              </div>
              
              <div class="form-group">
                <label>Course Name</label>
                <input type="text" class="form-control" name="cname" placeholder="">
              </div>

              <div class="form-group">
                <label>Department</label>
                <input type="text" class="form-control" name="cdepartment" placeholder="">
              </div>

              <div class="form-group">
                <label>Credit</label>
                <input type="text" class="form-control" name="credit" placeholder="">
              </div>

              <div class="form-group">
                <label>Description</label>
                <textarea type="text" class="form-control" name="course_intro" rows="5"> </textarea>
              </div>

              <br>

              <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <button type="" class="btn btn-default" name="reset" value="reset">Reset</button>
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