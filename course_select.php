<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php 
include 'check_access.php'; 
?>

<!-- accessing database -->
<?php 
// $user_id = $_SEESION['user_id'];
?>

<!-- include head file-->
<head> 
  <?php include 'header.php'; ?>  
  <script type="text/javascript" src="js/course.js"></script>
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

      <!-- 查询框 -->
      <div class="panel panel-default" id="queryForm"> 
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
                You have deleted course successfully!
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
            <td align='center' id="description"><small> Description </small></td>
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