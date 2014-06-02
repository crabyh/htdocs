<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php //include 'check_access.php'; ?>

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

$user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
$query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
$data = mysqli_query($dbc,$query);
// if(mysqli_num_rows($data)==1){
  // $row = mysqli_fetch_array($data);
  // $_SESSION['department'] = $row['department'];
  // $_SESSION['gender'] = $row['gender'];
  // $_SESSION['birthyear'] = $row['birthyear'];
  // $_SESSION['birthmonth'] = $row['birthmonth'];
  // $_SESSION['birthday'] = $row['birthday'];
  // $_SESSION['enroll_time'] = $row['enroll_time'];
  // $_SESSION['phone'] = $row['phone'];
  // $_SESSION['email'] = $row['email'];
  // }
?>

<!-- include head file-->
<head>
<?php include 'header.php'; ?> 
</head>

<body>
     <!--<link href="css/flat-ui.css" rel="stylesheet"> -->

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?> 

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h3> Course Information <small></small></h3>
         
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
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

            <select name="order" class="slelect select-default">
              <option value="">Order By</option>
              <option value="all">All</option>
              <option value="cid">Course ID</option>
              <option value="cname">Course Name</option>
              <option value="dept">Department</option>
              <option value="credit">Credit</option>
            </select>
          </span>
            <div class="input-group-inline" id="input_2">
            <div class="row clearfix">
              <div class="col-md-4 column">
                <input id="limit_down" type="text" placeholder="Lower Bound" class="form-control" name ="down">
              </div>
              <div class="col-md-4 column">
                <input id="limit_up"  type="text" placeholder="Upper Bound" class="form-control" name ="up">
              </div>
              <div class="col-md-4 column">
               <input type="text" id="input_1" placeholder="Keyword" class="form-control" name="keyword">
             </div>
            </div>
          </div>

          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary" type="button" name="submit">Search</button>
          </span>
        </form>
<!-- <div class="input-group">
  <input type="text" class="form-control">
  <span class="input-group-addon">.00</span>
</div> -->
        </div></div>
          <div class="panel-body"> 
            <?php
        error_reporting(0);
        echo $_POST["submit"];
        $con=mysqli_connect("127.0.0.1","root","1324","seproject");
        $seltype=$_GET["seltype"];
        $keyword=$_GET["keyword"];
        $up=$_GET["up"];
        $down=$_GET["down"];
        $order=$_GET["order"];
        if(!$seltype){
          echo '
          </table>
          </div>
          <div class="footer">
          <p>&copy; Implemented by Group 1 </p>
          </div>'; 
        }
        if($seltype=="all")
          $sql="SELECT * FROM course_info;";
        else{
          if($up)
             $sql = "SELECT * FROM course_info WHERE $seltype>=$up AND $seltype <= $down ORDER BY $order;";
          else {
             $sql = "SELECT * FROM courst_info WHERE $seltype LIKE '%$keyword%' ORDER BY $order;";
          }
        }
        //if($seltype="no_select")
          //$sql="SELECT * FROM books WHERE bname='oh,i'm not a book";
        $arr=mysqli_query($con,$sql) or die("");
        if($arr){
          echo '<table class="table table-striped">';
          echo' <div class="panel-heading" align="center">Search Result</div>';
          echo '<tr>';
          echo  "<td align='center'> Course ID</td>";
          echo  "<td align='center'> Course Name</td>";
          echo  "<td align='center'> Department</td>";
          echo  "<td align='center'> Credit</td>";
          echo  "<td align='center'> Description</td>";
          echo  "<td align='center'colspan='2'> Action</td>";
          
          // echo  "<td align='center'></td>";


          // echo  "<td "
          echo '</tr>';
        }
        while($val=mysqli_fetch_row($arr)){
           echo "<tr >";
        for($i=0;$i<count($val);$i++){
                echo "<td align='center'>".$val[$i]."</td>";
                //echo "<td align='center'><a href='update.php?id=$val[0]' target='_parent'>修改</a>|<a href='del.php?id=$val[0]' target='_parent''>删除</a>"."</td>";
           }
           echo "<td align='right'><button class='btn btn-sm btn-default' href=''>Edit</button></td>";
           echo "<td align='left'><button class='btn btn-sm btn-default' href=''>Delete</button></td>";
         
        echo "</tr>";
      }

      ?>

      </table>
      </div></div>
        </div> 
        <!-- <select class="selectpicker"> -->
          <!-- <option value="0">By Course ID</option> -->
          <!-- <option value="1">By Course Name</option> -->
          <!-- <option value="1">By Department</option> -->
          <!-- <option value="1">By Credit</option> -->
         <!-- </select> -->
          <!--<script language="JavaScript"> 
          $("select").selectpicker({style: 'btn-hg btn-primary', menuStyle: 'dropdown-inverse'}); 
          </script> 

        <div class="panel-body">
        </div>
        <form method="get" action="course_select.php">
        <div class="input-group">
          <span class="input-group-addon">

            <select name="seltype" id="search_menu" class="slelect select-default">
              <option value="">Sort By</option>
              <option value="all">All</option>
              <option value="cid">Course ID</option>
              <option value="cname">Course Name</option>
              <option value="dept">Department</option>
              <option value="credit">Credit</option>
            </select>

            <select name="order" class="slelect select-default">
              <option value="">Order By</option>
              <option value="all">All</option>
              <option value="cid">Course ID</option>
              <option value="cname">Course Name</option>
              <option value="dept">Department</option>
              <option value="credit">Credit</option>
            </select>
          </span>
          <!-- /btn-group -->

          <!-- <input type="text" id="input_1" placeholder="Keyword" class="form-control" name="keyword"> -->
          
        <!-- /input-group --> 
      <!-- </form> -->
        <!-- <link href="css/flat-ui.css" rel="stylesheet"> -->
        
        

        
    </div>

    <!-- clear user_info Session -->
    <!-- <?php
      // unset($_SESSION['department']);
      // unset($_SESSION['gender']);
      // unset($_SESSION['birthyear']);
      // unset($_SESSION['birthmonth']);
      // unset($_SESSION['birthday']);
      // unset($_SESSION['enroll_time']);
      // unset($_SESSION['phone']);
      // unset($_SESSION['email']);
     ?> -->

    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>