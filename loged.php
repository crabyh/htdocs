<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- include head file-->
<head>
<?php include 'header.php'; ?>
</head>

<body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <?php include 'navigation.php'; ?>

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
            <?php if(isset($_GET['passw_ch'])):?>
                <div class="alert alert-success alert-dismissable">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4>
                    Password changing success!
                  </h4> <strong>Please remember your new password.</strong>
                </div>
            <?php endif;?>
            <h1>WELCOME</h1>
        </div>

        <!-- page body -->             
        <div>
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
              <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
            </ol>
            <div class="carousel-inner">
              <div class="item">
                <img data-src="http://eduss.sinaapp.com/img/IMG_8711.jpg" alt="First slide" src="http://eduss.sinaapp.com/img/IMG_8711.jpg">
              </div>
              <div class="item active">
                <img data-src="http://eduss.sinaapp.com/img/IMG_8895.jpg" alt="First slide" src="http://eduss.sinaapp.com/img/IMG_8895.jpg">
              </div>
              <div class="item">
                <img data-src="http://eduss.sinaapp.com/img/IMG_8922.jpg" alt="First slide" src="http://eduss.sinaapp.com/img/IMG_8922.jpg">
              </div>
            </div>
            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
          </div>
        </div>	  
      </div>
    </div>
    <br />
    <!-- page footer -->
    <?php include"footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>