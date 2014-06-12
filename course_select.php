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
          <!-- 查询表单 -->
          <form>
            <div class="input-group">
              <span class="input-group-addon">
                <select name="seltype" id="seltype" class="selectpicker">
                  <option value="">Query By</option>
                  <option value="cid">Course ID</option>
                  <option value="cname">Course Name</option>
                  <option value="cdepartment">Department</option>
                  <option value="credit">Credit</option>
                </select>
              </span>
              <span class="input-group-addon">
                <select name="" id="order">
                  <option value="">Order By</option>
                  <option value="cid">Course ID</option>
                  <option value="cname">Course Name</option>
                  <option value="cdepartment">Department</option>
                  <option value="credit">Credit</option>
                </select>
              </span>
              <span>
                <input type="text" placeholder="Keyword" class="form-control" name="keyword" id="courseKeyword">
              </span>
            </div>
          </form>
        </div> 

        <div id="res" style="display: none">
          <h4 align="center">Search Results</h4>
          <p id="prompt" align="center"></p>
          <table class="table table-striped" id="table">
            <tr id="tableHead">
            <td align='center'><small> Course ID </small></td>
            <td align='center'><small> Course Name </small></td>
            <td align='center'><small> Department </small></td>
            <td align='center'><small> Credit </small></td>
            <td align='center'><small> Description </small></td>
            <td align='center'colspan='3'><small> Action </small></td>
            </tr>
          </table>
        </div>
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
</body>
</html>