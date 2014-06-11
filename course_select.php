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
<head> 
  <?php include 'header.php'; ?>  
</head>

<body>
  <div id="wrap">

    <!-- Fixed navbar -->
    <?php include 'navigation.php'; ?> 

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">  
        <h1> 
          Course Information 
        </h1>      
      </div>

      <div class="panel panel-default" id="queryForm"> <!-- 查询框 -->
        <div class="panel-heading">
        <p></p>
          <form>
            <div class="input-group">
              <span class="input-group-addon">
                <select name="seltype" id="query" class="selectpicker">
                  <option value="">Query By</option>
                  <option value="all">All</option>
                  <option value="cid">Course ID</option>
                  <option value="cname">Course Name</option>
                  <option value="dept">Department</option>
                  <option value="credit">Credit</option>
                </select>
              </span>
              <span class="input-group-addon">
                <select name="order" id="order">
                  <option value="">Order By</option>
                  <option value="all">All</option>
                  <option value="cid">Course ID</option>
                  <option value="cname">Course Name</option>
                  <option value="dept">Department</option>
                  <option value="credit">Credit</option>
                </select>
              </span>
              <span>
                <input type="text" placeholder="Keyword" class="form-control" name="keyword" id="keyword">
              </span>
              <span class="input-group-btn">
                <button class="btn btn-primary" name="submit">Search</button>
              </span>
            </div>
          </form>
        </div> 
        <?php
          if(isset($_GET['submit']))
          {
            echo'<h4 align="center">Search Results</h4>';
            $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            $seltype=$_GET["seltype"];
            $keyword=$_GET["keyword"];
            $order=$_GET["order"];
            if($seltype=="all") //选出所有数据，不需要keyword
            {
              if ($order)  //有排序选项 
                $sql='SELECT * FROM course_info ORDER BY '.$order.';';
              else 
                $sql = 'SELECT * FROM course_info;';
            }
            else { // 根据seltype来筛选，需要keyword
              if ($order) 
                $sql = 'SELECT * FROM course_info WHERE '.$seltype.' LIKE "%'.$keyword.'%" ORDER BY '.$order.';';
              else 
                $sql = 'SELECT * FROM course_info WHERE '.$seltype.' LIKE "%'.$keyword.'%";';
            }
            
            $arr=mysqli_query($dbc, $sql); 
            if($arr){ //如果从数据库中取出数据
              echo '<table class="table table-striped">';
              echo '<tr>';
              echo  "<td align='center'><small> Course ID </small></td>";
              echo  "<td align='center'><small> Course Name </small></td>";
              echo  "<td align='center'><small> Department </small></td>";
              echo  "<td align='center'><small> Credit </small></td>";
              echo  "<td align='center'><small> Description </small></td>";
              echo  "<td align='center'colspan='3'><small> Action </small></td>";
              echo '</tr>';
              while($val=mysqli_fetch_row($arr)){
                echo "<tr>";
                for($i=0;$i<count($val);$i++){
                  echo "<td align='center'><small>".$val[$i]."</small></td>";
                }
                  echo "<td align='right'><a type='button' class='btn btn-sm btn-default' href='course_info.php?course_id=".$val[0]."'>More</a></td>";
                  echo "<td align='left'><a type='button' class='btn btn-sm btn-default' href=''>Delete</a></td>";
                  echo "</tr>";
              } // end WHILE
              echo "</table>";
            } // end IF 取数据
            else echo '<h5 align="center">There is no records!</h5>';
          } 
        ?> 
      </div> 

    </div>
  </div>

          
        <!-- </div> -->
   

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