<?php session_start();?>
<html lang="en">

<!-- It's a page without sign-in -->
<!--?php include 'check_access.php'; ?-->

<!-- include head file-->

<head>
<?php include 'header.php'; ?>
<script type="text/javascript">
function act(){
  var user = document.getElementById("home")
  user.className = "active"
}
</script>
</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1>Find Password</h1>
        </div>

        <!-- page body -->
        <!-- accessing database -->
        <?php
          require_once 'connectvars.php'; 
          $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
          $query = "SELECT * FROM accounts WHERE usertype = 'admin'";
          $data = mysqli_query($dbc,$query);
          if(!mysqli_num_rows($data))
            echo'<p class="lead">Sorry, but we can not find the information of the admin.We are trying to solve the problem for you.</p>';
          else
          {
            $row = mysqli_fetch_array($data);
            $id = $row['user_id'];
            $query1 = "SELECT * FROM user_info WHERE user_id = '$id'";
            $data1 = mysqli_query($dbc,$query1);
            if(mysqli_num_rows($data1))
            {
              $row1 = mysqli_fetch_array($data1);
              $adminname = $row1['username'];
              $adminemail = $row1['email'];
              $admintel = $row1['phone'];
              echo'<nav class="navbar navbar-default" role="navigation">
                   <div class="navbar-header">
                   <p> </p>
                   <p class="lead">Please contact the administrator to find the password for you .His name is '.$adminname.'.</p>
                   <p class="lead">Here is his Contact Information:</p>
                   <p class="lead">Tel:'.$admintel.'  Email:'.$adminemail.'</p>
                   </div>
                   </nav>
                   ';
            }
          }     
        ?>

      </div>
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