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

        <!-- accessing database -->
        <?php
    			require_once 'connectvars.php'; 
                $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    			$query = "SELECT * FROM user_info WHERE username = 'admin'";
    			$data = mysqli_query($dbc,$query);
    			if(mysqli_num_rows($data)==0)//没有这个用户
    			{
    			 echo'<div class="alert alert-danger alert-dismissable">
                               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <h4>
                                User does not exist!
                              </h4> <strong>Please check the user name and try again.</strong></a>
                            </div>';
    			}
    			else
    			{
    			    if(mysqli_num_rows($data)==1)
    			    {
    				  $row = mysqli_fetch_array($data);
    					$adminemail = $row['email'];
    					$admintel = $row['phone'];
    			    }
    			}			
        ?>

        <h1>Find Password</h1>
        </div>

        <!-- page body -->
        <p class="lead">Please contact the administrator to find the password for you.</p>
        <p class="lead">Here is his Contact Information: Tel:<?php echo $admintel;?>;Email:<?php echo $adminemail;?></p>
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