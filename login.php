<?php
session_start();
if(isset($_SESSION["user_id"]))
  echo'
  <script type="text/javascript"> 
  setTimeout(window.location.href="loged.php",3); 
  </script>';

//插入连接数据库的相关信息
require_once 'connectvars.php';
?>

<html lang="zh-cn">
<head>
  <?php include 'header.php'; ?>
  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
  <script type='text/javascript'>
  function refreshCaptcha()
  {
      var img = document.images['captchaimg'];
      img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
  }
  </script>
</head>

<body>

  <div class="container">
    <?php 
      if(!isset($_SESSION['user_id'])){ //如果登录没有登录，执行以下代码
        if (isset($_REQUEST['Submit'])){ //如果有submit提交
          // if(empty($_SESSION['6_letters_code']) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
          //   { 
          //     $msg="Verification code is wrong!";
          //   }
          // else
            { //验证码通过验证
            $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
            $user_id = mysqli_real_escape_string($dbc,trim($_POST['user_id']));
            $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
            $md5_user_password=md5("$user_password"); //PHP中的mds()函数用于对字符串进行加密
            $query = "SELECT user_id, usertype FROM accounts WHERE user_id = '$user_id' AND password = '$md5_user_password'";
            $data = mysqli_query($dbc,$query);
            $error = true;
            if(mysqli_num_rows($data)==1){ //用用户名和密码进行查询，若查到的记录正好为一条，则将登录写入系统日志，设置SESSION和COOKIE，同时进行页面重定向
              // //写入系统日志
              // $sysfile=fopen("SystemLog/SystemLog.txt","a+")or exit("Unable to open SystemLog file!");
              //    fwrite($sysfile,"<br /><br />".$_POST['user_id']." loged in the system at ".date('Y-m-d H:i'));
              // fclose($sysfile);
              //写入系统日志结束
              $row = mysqli_fetch_array($data);
              $_SESSION['user_id']=$row['user_id'];
              $_SESSION['usertype']=$row['usertype'];
              $query = "SELECT user_id, username FROM user_info WHERE user_id = '$user_id'";
              $data = mysqli_query($dbc,$query);
              $row = mysqli_fetch_array($data);
              $_SESSION['username']=$row['username'];
              $home_url = 'loged.php';
              header('Location: '.$home_url);
              $response = "ok";
            } //end IF mysqli_num_rows
          } // end ELSE  
        } // end IF submit
      } // end IF session userid 
    ?>
    <?php if(isset($msg)){ ?>
      <div class="alert alert-danger" id="codefail">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>
          <?php echo $msg;?>
        </h4> <strong>please check, then try again.</strong></a>
      </div>
    <?php } ?>
    <?php if(isset($error)){ ?>
      <div class="alert alert-danger" id="codefail">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>
          Your code is wrong!
        </h4> <strong>please check, then try again.</strong></a>
      </div>
    <?php } ?>

    <form class="form-signin" method="post" name="form1" id="form1" action=""> 
      <h2 class="form-signin-heading">Please Sign In</h2>
      <input type="text" class="form-control" placeholder="User ID" name="user_id" id="user_id" required autofocus value="<?php if(!empty($user_id)) echo $user_id; ?>">
      <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
      <!-- required here -->
      <div class="row">
        <div class="col-xs-7">
          <input type="tel" class="form-control" id="6_letters_code" placeholder="verification code" name="6_letters_code">
          </div>
        <div class="col-xs-5" align="rignt">
          <a href='javascript: refreshCaptcha();'><img id='captchaimg' src="captcha_code_file.php?rand=<?php echo rand();?>"/> </a>

          </div>
        </div>
      <p></p>
      <!-- <label class="checkbox">
        <input type="checkbox" value="remember-me">Remember me</label> -->
      <input class="btn btn-lg btn-primary btn-block" name="Submit" type="submit" onclick="return validate();" value="Submit">
      <a href='#'>Forget password?</a>
    </form>

  </div>
  <!-- /container -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
