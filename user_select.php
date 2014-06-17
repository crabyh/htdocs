<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!--CheckUserType-->
<?php 
include 'check_user_type.php';
CheckUserType('manager');
?> 

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
  <script type="text/javascript" src="js/user.js"></script>
</head>

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

          <!-- Warn Modal -->
          <div class="modal fade" id="warnModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="warnModalLabel">Delete</h4>
                </div>
                <div class="modal-body">
                  Are you sure to delete?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="closeBTN">Close</button>
                  <button type="button" class="btn btn-default btn-danger" data-dismiss="modal" id="deleteBTN" data-toggle='modal' data-target='#successModal'>Delete</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <!-- success Modal -->
          <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="successModalLabel">Success</h4>
                </div>
                <div class="modal-body">
                  You have deleted user successfully!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->

          <!-- Fail Modal -->
          <div class="modal fade" id="failModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="failModalLabel">Failed</h4>
                </div>
                <div class="modal-body">
                  Delete falied! Please try agian!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
          
            <form>
              <div class="input-group">
              	<span class="input-group-addon">Query Criteria
                  <select name="seltype" class="selectpicker" id="seltype">
                    <option value="user_id">User ID</option>
                    <option value="username">User Name</option>
                    <option value="gender">Gender</option>
                    <option value="enroll_time">Enroll Time</option>
                    <option value="phone">Phone</option>
                    <option value="email">Email</option>
                  </select>
                </span>
                <span class="input-group-addon">Order By
                  <select name="order" id='order'>
                    <option value="user_id">User ID</option>
                    <option value="username">User Name</option>
                    <option value="gender">Gender</option>
                    <option value="enroll_time">Enroll Time</option>
                    <option value="phone">Phone</option>
                    <option value="email">Email</option>
                  </select>
                </span>
                <span>
                  <input type="text" id="userKeyword" placeholder="Typing keyword here to start search" class="form-control" name="keyword">
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