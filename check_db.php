<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- CheckUserType -->
<?php 
include 'check_user_type.php';
CheckUserType('admin');
?> 

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
$query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
$data = mysqli_query($dbc,$query);
?>

<?php
$sqlacc= 'SELECT * FROM accounts';
$sqlcourse = 'SELECT * FROM course_info';
$sqluser = 'SELECT * FROM user_info';
$sqlclass = 'SELECT * FROM class_info';

$arracc = mysqli_query($dbc, $sqlacc);
$arrcourse = mysqli_query($dbc, $sqlcourse);
$arruser = mysqli_query($dbc, $sqluser);
$arrclass = mysqli_query($dbc, $sqlclass);

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
          View Database
        </h1>      
      </div>

    <div class="bs-example bs-example-tabs">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#accounts" data-toggle="tab">accounts</a></li>
        <li class=""><a href="#course_info" data-toggle="tab" id="profileLable">course_info</a></li>
        <li class=""><a href="#class_info" data-toggle="tab" id="profLable">class_info</a></li>
        <li class=""><a href="#user_info" data-toggle="tab" id="proLable">user_info</a></li>
      </ul>

      <div class="tab-content">
        <div class="tab-pane fade active in" id="accounts">
          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table table-striped">
                <tr>
                  <td align='center'><small> user_id </small></td>
                  <td align='center'><small> password </small></td>
                  <td align='center'><small> usertype </small></td>
                </tr> 
                <?php
    				
                    while($row = mysqli_fetch_row($arracc)){
                        echo "<tr>";
                        foreach ($row as $key => $value){
                            echo "<td align='center'><small>".$value."</small></td>";
                        }
                        echo "<tr>";
                    }
                ?>
              </table>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="course_info">
          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table table-striped">
                <tr>
                <td align='center'><small> cid </small></td>
                <td align='center'><small> cname </small></td>
                <td align='center'><small> cdepartment </small></td>
                <td align='center'><small> credit </small></td>
                <td align='center'><small> course_intro </small></td>
                </tr>
                <?php 
    				while($row = mysqli_fetch_row($arrcourse)){
                        echo "<tr>";
                        foreach ($row as $key => $value){
                            echo "<td align='center'><small>".$value."</small></td>";
                        }
                        echo "<tr>";
                    }
                ?>
              </table>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="class_info">
          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table table-striped">
                <tr>
                <td align='center'><small> class_id </small></td>
                <td align='center'><small> t_id </small></td>
                <td align='center'><small> c_hour </small></td>
                <td align='center'><small> quantity </small></td>
                <td align='center'><small> cid </small></td>
                </tr>
                <?php 
            while($row = mysqli_fetch_row($arrclass)){
                        echo "<tr>";
                        foreach ($row as $key => $value){
                            echo "<td align='center'><small>".$value."</small></td>";
                        }
                        echo "<tr>";
                    }
                ?>
              </table>
            </div>
          </div>
        </div>

         <div class="tab-pane fade" id="user_info">
          <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-striped">
                  <tr>
                  <td align='center'><small> user_id </small></td>
                  <td align='center'><small> username </small></td>
                  <td align='center'><small> department </small></td>
                  <td align='center'><small> gender </small></td>
                  <td align='center'><small> birthday </small></td>
                  <td align='center'><small> enroll_time </small></td>
                  <td align='center'><small> phone </small></td>
                  <td align='center'><small> email </small></td>
                  </tr>
                  <?php
      				while($row = mysqli_fetch_row($arruser)){
                          echo "<tr>";
                          foreach ($row as $key => $value){
                              echo "<td align='center'><small>".$value."</small></td>";
                          }
                          echo "<tr>";
                      }
                  ?>
                </table>
              </div>
            </div>

        </div>
      </div>
    </div>



    </div>

  </div>


  <!-- page footer -->
  <?php include"footer.php"; ?>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>


</body>

</html>