<?php
session_start();
if(isset($_SESSION["user_id"]))
  echo'
  <script type="text/javascript"> 
  setTimeout(window.location.href="loged.php",3); 
  </script>';

//插入连接数据库的相关信息
require_once 'connectvars.php';

$error_msg = "";
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id'])){
    if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $user_id = mysqli_real_escape_string($dbc,trim($_POST['user_id']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
        if(!empty($user_id)&&!empty($user_password)){
          //PHP中的mds()函数用于对字符串进行加密
          $md5_user_password=md5("$user_password");
          $query = "SELECT user_id, usertype FROM accounts WHERE user_id = '$user_id' AND password = '$md5_user_password'";
          $data = mysqli_query($dbc,$query);
          //用用户名和密码进行查询，若查到的记录正好为一条，则设置SESSION和COOKIE，同时进行页面重定向
          if(mysqli_num_rows($data)==1){
              $row = mysqli_fetch_array($data);
              $_SESSION['user_id']=$row['user_id'];
              $_SESSION['usertype']=$row['usertype'];
              $query = "SELECT user_id, username FROM user_info WHERE user_id = '$user_id'";
              $data = mysqli_query($dbc,$query);
              $row = mysqli_fetch_array($data);
              $_SESSION['username']=$row['username'];
              setcookie('user_id',$row['user_id'],time()+(60*60*24*30));
              setcookie('username',$row['username'],time()+(60*60*24*30));
              setcookie('usertype',$row['usertype'],time()+(60*60*24*30));
              $home_url = 'loged.php';
              header('Location: '.$home_url);
          }else{//若查到的记录不对，则设置错误信息
              $error_msg = 'Sorry, you must enter a valid username and password to log in.';
          }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
}
?>
<html lang="zh-cn">
<head>
  <?php include 'header.php'; ?>
  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
</head>

<body>

  <div class="container">
    <?php if(isset($_POST['submit']))
      echo '<div class="alert alert-danger fade in"">
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>
         User ID/password wrong!!!
        </h4> <strong>please check your user ID and password, then try again.</strong></a>
      </div>'
    ?>
    <form class="form-signin" role="form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <h2 class="form-signin-heading">Please Sign In</h2>
      <input type="text" class="form-control" placeholder="User ID" name="user_id" id="user_id" required autofocus value="<?php if(!empty($user_id)) echo $user_id; ?>">
      <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
      <label class="checkbox">
        <input type="checkbox" value="remember-me">Remember me</label>
      <button class="btn btn-lg btn-primary btn-block" type="submit" value="Log In" name="submit">Sign In</button>
      <button type="button" class="btn btn-lg btn-deflaut btn-block" href="#">Find password</button>
    </form>

  </div>
  <!-- /container -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>