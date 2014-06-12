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
        <?php
        if(isset($_SESSION['login'])) 
          echo'<div class="alert alert-success alert-dismissable">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4>
            Sign Out
          </h4> <strong>You have been sign out successful.</strong></a>
        </div>';
        else if(isset($_SESSION['illegal']))
          echo'<div class="alert alert-danger fade in"">
           <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4>
            Illegal Access
          </h4> <strong>xxxxxxx.</strong></a>
        </div>';
        unset($_SESSION['login']);
        unset($_SESSION['illegal']);
        ?>
          <h1>upload</h1>
        </div>

        <!-- page body -->
        <!-- <p class="lead">Enjoy the system. Have fun!</p> -->
        <!--open system log file and print it -->


        <!--上面这段php就是输出系统日志文件的整个结构，如果要美化的话在外面加个框吧 by女王-->
<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Upload Icon</h4>
      </div><!-- 里面的内容 -->

      <div class="modal-body">
        <p2>Choose a picture from your computer to upload as your icon.<br />
            Pay attention that you could only upload <b>jpg</b> fileand the size of your file couldn't be lager than <b>20kb</b>.<br /><br /></p>
        <form method="POST" action="upload.php" enctype="multipart/form-data">
          <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
          <input type="file" name="file" id="file"/><br />
          <input class="btn btn-primary" type="submit" value="Upload" /></p>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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





<?php 
if(isset($_FILES["file"]))
{
  if ((//($_FILES["file"]["type"] == "image/png")||
     ($_FILES["file"]["type"] == "image/jpeg")
  || ($_FILES["file"]["type"] == "image/pjpeg")
  )
  && ($_FILES["file"]["size"] < 2000000))
    {
    if ($_FILES["file"]["error"] > 0)
      {
      echo "Error: " . $_FILES["file"]["error"] . "<br />";//上传错误
      }
    else
      {
      $iconname = $_SESSION['user_id'] . ".jpg";
      move_uploaded_file($_FILES["file"]["tmp_name"],"uploadicon/" . $iconname);
      echo "Stored in: " . "uploadicon/" . $iconname;          

      //输出文件信息 测试用
      echo "Upload: " . $_FILES["file"]["name"] . "<br />";
      echo "Type: " . $_FILES["file"]["type"] . "<br />";
      echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
      echo "Stored in: " . $_FILES["file"]["tmp_name"] . "<br />";
      //输出文件信息结束

//      if (file_exists("upload/" . $_FILES["file"]["name"]))
//      {
//      echo $_FILES["file"]["name"] . " already exists. ";
//      }
//      else
//      {

//      }
      }
    }
    else
      echo "file type or size wrong.";
}
?>
