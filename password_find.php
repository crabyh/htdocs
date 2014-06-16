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
		<h2>Please contact the admin to find the password for you.</h2>
        </div>

        <!-- page body -->
        <div class="row clearfix">

          <div class="col-md-4 column">
            <form role="form" id = "former" action="password_find.php?" method="POST">

              <div class="form-group">
                <label for="UserID">Tel: </label>
				<?php echo $admintel;?>
              </div>

              <div class="form-group">
                <label for="E-mail">E-mail: </label>
				<?php echo $adminemail;?>
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
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>