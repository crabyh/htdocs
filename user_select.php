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
          <h1> User Query <small></small></h1>      
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
          <p></p>
            <form>
              <div class="input-group">
                <span class="input-group-addon">
                  <select name="seltype" class="selectpicker" id="seltype">
                    <option value="">Query By</option>
                    <option value="user_id">User ID</option>
                    <option value="username">User Name</option>
                    <option value="gender">Gender</option>
                    <option value="enroll_time">Enroll Time</option>
                    <option value="phone">Phone</option>
                    <option value="email">Email</option>
                  </select>
                </span>
                <span class="input-group-addon">
                  <select name="order" id='order'>
                    <option value="">Order By</option>
                    <option value="user_id">User ID</option>
                    <option value="username">User Name</option>
                    <option value="gender">Gender</option>
                    <option value="enroll_time">Enroll Time</option>
                    <option value="phone">Phone</option>
                    <option value="email">Email</option>
                  </select>
                </span>
                <span>
                  <input type="text" id="userKeyword" placeholder="Keyword" class="form-control" name="keyword">
                </span>
              </div> 
            </form>
          </div>  

          <div id="res" style="display: none">
            <h4 align="center">Search Results</h4>
            <p id="prompt" align="center"></p>
            <table class="table table-striped" id="table">
              <tr id="tableHead">
              <td align='center'><small> User ID </small></td>
              <td align='center'><small> User Name </small></td>
              <td align='center'><small> Department </small></td>
              <td align='center'><small> Gender </small></td>
              <td align='center'><small> Birthday </small></td>
              <td align='center'><small> Enroll Time </small></td>
              <td align='center'><small> Phone </small></td>
              <td align='center'><small> Email </small></td>
              <td align='center'><small> Description </small></td>
              <td align='center'colspan='3'><small> Action </small></td>
              </tr>
            </table>
          </div>

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