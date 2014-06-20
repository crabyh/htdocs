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
          $course_intro = $_POST['course_intro'];
          $c_hour = $_POST['c_hour'];
          if(mysqli_num_rows($data)==1)
            echo'<div class="alert alert-danger alert-dismissable">
                     <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>
                      This cid '.$cid.' is already existed!
                    </h4> <strong>Please try another one.</strong>
                  </div>';
          else{
            $courseQuery = "INSERT INTO course_info (cid, cname, cdepartment, credit, course_intro) VALUES ('$cid', '$cname', '$cdepartment', $credit, '$course_intro')";
            mysqli_query($dbc, $courseQuery);
            for ($i=0; $i < count($_POST['teacher']); $i++) { 
              $teacher = $_POST['teacher'][$i];
              $quantity = $_POST['quantity'][$i];
              if ($i >= 0 && $i <= 9) {  //如果班级数小于10，在前面补0
                $j = "0".$i;
              }
              else $j = $i; 
              $class_id = $cid."$j";
              $classQuery = "INSERT INTO class_info (class_id, user_id, c_hour, quantity, cid) VALUES ('$class_id', '$teacher', $c_hour, $quantity, '$cid')";
              $result = mysqli_query($dbc, $classQuery);
              if ($result) {
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
              else {
                echo'<div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>
                    Adding course FAILED!
                  </h4>
                  <p> There is no such teacher </p>
                </div>';
                $deleteQuery = "DELETE FROM course_info WHERE cid = '$cid'";
                mysqli_query($dbc, $deleteQuery);
              }
            } //end for
          }
        }
        ?>

          <h2 >Add Course</h2>
        </div>

        <!-- page body -->
        <form class="form" method="post">
          <div class="row clearfix">
            <div class="col-md-6 column">
                
                <div class="form-group">
                  <label>Course ID</label>
                  <input type="text" class="form-control" name="cid" placeholder="" maxlength="20">
                </div>
                
                <div class="form-group">
                  <label>Course Name</label>
                  <input type="text" class="form-control" name="cname" placeholder="" maxlength="60">
                </div>

                <div class="form-group">
                  <label>Department</label>
                  <input type="text" class="form-control" name="cdepartment" placeholder="" maxlength="40">
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
                  <label>Description</label>
                  <textarea type="text" class="form-control" name="course_intro" rows="5" maxlength="2000"> </textarea>
                </div>
              </div> <!-- 左边的框 -->

            <div class="col-md-6 column">

              <div class="row">
                <div class="form-group col-md-6">
                  <label>Teacher ID</label>
                  <input type="text" class="form-control" name="teacher[]" placeholder="" maxlength="20">
                </div>

                <div class="form-group col-md-6">
                  <label>Capacity</label>
                  <input type="text" class="form-control" name="quantity[]" placeholder="" maxlength="3">
                </div>

                <div class="form-group col-md-6">
                  <button class="btn btn-default" id="addClass">Add Classes</button>
                </div>
              </div> <!-- end row -->

            </div>  <!-- 右边的框 -->
          </div><!-- end row -->
          <br>
          <div class="form-group" align="center">
            <button type="submit" class="btn btn-lg btn-primary" name="submit" value="submit">Submit</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="" class="btn btn-lg" name="reset" value="reset">Reset</button>
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