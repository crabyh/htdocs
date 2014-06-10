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
?>

<!-- include head file-->
<head> <?php include 'header.php'; ?>  </head>

<body>
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?> 

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1> Course Information <small></small></h1>      
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
          <p></p>
            <form method="get" action="course_select.php">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <select name="seltype" id="search_menu" class="selectpicker">
                        <option value="">Sort By</option>
                        <option value="all">All</option>
                        <option value="cid">Course ID</option>
                        <option value="cname">Course Name</option>
                        <option value="dept">Department</option>
                        <option value="credit">Credit</option>
                      </select>
                      </span>
                      <span class="input-group-addon">
                      <select name="order">
                        <option value="">Order By</option>
                        <option value="all">All</option>
                        <option value="cid">Course ID</option>
                        <option value="cname">Course Name</option>
                        <option value="dept">Department</option>
                        <option value="credit">Credit</option>
                      </select>
                    </span>
                    <span>
                    <input type="text" id="input_1" placeholder="Keyword" class="form-control" name="keyword">
                    </span>

                  <!-- <div class="input-group-inline" id="input_2">
                    <div class="row clearfix">
                      <div class="col-md-4 column">
                        <input id="limit_down" type="text" placeholder="Lower Bound" class="form-control" name ="lower_bound">
                      </div>
                      <div class="col-md-4 column">
                        <input id="limit_up"  type="text" placeholder="Upper Bound" class="form-control" name ="upper_bound">
                      </div>
                      <div class="col-md-4 column">
                       <input type="text" id="input_1" placeholder="Keyword" class="form-control" name="keyword">
                      </div>
                    </div>
                  </div> -->
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary" type="button" name="submit">Search</button>
                  </span>
            </form>
          </div> 
          </div>        
            <?php
              if(isset($_GET['submit']))
              {
                echo'<h4 align="center">Search Resault</h4>';
                $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                $seltype=$_GET["seltype"];
                $keyword=$_GET["keyword"];
                $up=$_GET["lower_bound"];
                $down=$_GET["upper_bound"];
                $order=$_GET["order"];
                if($seltype=="all")
                  $sql="SELECT * FROM course_info;";
                
                else{
                  if($up)
                     $sql = "SELECT * FROM course_info WHERE $seltype>=$lower_bound AND $seltype <= $upper_bound ORDER BY $order;";
                  else {
                     $sql = "SELECT * FROM courst_info WHERE $seltype LIKE '%$keyword%' ORDER BY $order;";
                  }
                } //筛选排序功能有问题的！from QX
                
                $arr=mysqli_query($dbc,$sql);
                if($arr){
                  echo '<table class="table table-striped">';
                  echo '<tr>';
                  echo  "<td align='center'><small> Course ID </small></td>";
                  echo  "<td align='center'><small> Course Name </small></td>";
                  echo  "<td align='center'><small> Department </small></td>";
                  echo  "<td align='center'><small> Credit </small></td>";
                  echo  "<td align='center'><small> Description </small></td>";
                  echo  "<td align='center'colspan='3'><small> Action </small></td>";
                  echo '</tr>';
                }
                while($val=mysqli_fetch_row($arr)){
                   echo "<tr>";
                for($i=0;$i<count($val);$i++){
                        echo "<td align='center'><small>".$val[$i]."</small></td>";
                   }
                   echo "<td align='right'><a type='button' class='btn btn-sm btn-default' href='course_info.php?course_id=".$val[0]."'>More</a></td>";
                   echo "<td align='left'><a type='button' class='btn btn-sm btn-default' href=''>Delete</a></td>";

                 
                echo "</tr>";
                
              }
              echo "</table>";
            }
            ?>
          <!-- </div> -->
        </div>
      </div>
    </div> 

    <!-- clear user_info Session -->

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>