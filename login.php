<?php
session_start();
if(isset($_SESSION["user_id"]))
  echo'
  <script type="text/javascript"> 
  setTimeout(window.location.href="loged.php",3); 
  </script>';

//插入连接数据库的相关信息
require_once 'connectvars.php';

// //如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
// if(!isset($_SESSION['user_id'])){
//   // if($authCode == $_SESSION['VCODE']){
//     if(isset($_POST['submit'])){//用户提交登录表单时执行如下代码
//         $authCode=$_POST["authCode"];
//         $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
//         $user_id = mysqli_real_escape_string($dbc,trim($_POST['user_id']));
//         $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
//         if(!empty($user_id)&&!empty($user_password)){ //user_id 和 user_password 不为空
//           if($authCode != $_SESSION['VCODE']){ //验证码错误
//             echo '<div class="alert alert-danger" fade in>
//              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
//               <h4>
//                Authetication code is wrong!!!
//               </h4> <strong>please check, then try again.</strong></a>
//             </div>';
//           }
//           else{ //验证码正确
//             //PHP中的mds()函数用于对字符串进行加密
//             $md5_user_password=md5("$user_password");
//             $query = "SELECT user_id, usertype FROM accounts WHERE user_id = '$user_id' AND password = '$md5_user_password'";
//             $data = mysqli_query($dbc,$query);
//             //用用户名和密码进行查询，若查到的记录正好为一条，则设置SESSION和COOKIE，同时进行页面重定向
//             if(mysqli_num_rows($data)==1){
//                 $row = mysqli_fetch_array($data);
//                 $_SESSION['user_id']=$row['user_id'];
//                 $_SESSION['usertype']=$row['usertype'];
//                 $query = "SELECT user_id, username FROM user_info WHERE user_id = '$user_id'";
//                 $data = mysqli_query($dbc,$query);
//                 $row = mysqli_fetch_array($data);
//                 $_SESSION['username']=$row['username'];
//                 setcookie('user_id',$row['user_id'],time()+(60*60*24*30));
//                 setcookie('username',$row['username'],time()+(60*60*24*30));
//                 setcookie('usertype',$row['usertype'],time()+(60*60*24*30));
//                 $home_url = 'loged.php';
//                 header('Location: '.$home_url);
//                 $response = "ok";
//               }
//               else{//若查到的记录不对，则设置错误信息
//                 $response = 'fail';
//               }
//             }
//         }else{
//             $response = 'empty';
//         }
//     }
// }
?>
<html lang="zh-cn">
<head>
  <?php include 'header.php'; ?>
  <!-- Custom styles for this template -->
  <link href="css/signin.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript">
  // 清除原来的数据
  function clearX(){
   document.getElementById('authCode').value="";
  }

  // 点击图片重新获得新的验证码：
  function getVCode() { 
    var vcode=document.getElementById('vcode'); 
    vcode.src ='yz.php?nocache='+new Date().getTime(); 
  }

  function done(){
    alert("");
  }

  // $("button#lBTN").click(function(event){
  //   event.preventDefault()
  //   var user_id = $("#user_id").val()
  //   var password = $("#password").val()
  //   var authCode = $("#authCode").val()
  //   // var rand = Math.random()
  //   alert("send")
  //   $.ajax({
  //     type: 'POST',
  //     url: "login.php",
  //     data: "user_id=" + user_id + "&password=" + password + "&authCode=" + authCode, //+ "&authCode=" + rand,
  //     success: function(){
  //       alert("haha")
  //       window.location.href = "login.php"
  //     },
  //     error: function(){
  //       alert("wuwu")
  //       $("#codefail").show()
  //     }
  //   })
  // })

  //定义XMLHttpRequest对象
  var xmlHttp;         

  // 创建 XMLHttpRequest:
  function createXmlHttpRequest(){
    var xmlHttp=null;
    try{
    // Firefox, Opera 8.0+, Safari
      xmlHttp=new XMLHttpRequest();
    }catch(e){
    // Internet Explorer
      try{
        xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
      }catch(e){
        xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    }
    return xmlHttp;
  }  

  function login(){
    var authCode=document.getElementById('authCode').value;
    var username=document.getElementById('user_id').value;
    var password=document.getElementById('password').value;
    if(username=="" || password=="" || authCode==""){
      alert("1");
      document.getElementById('codefail').style.display="block";
      // return false;
    }else{
      if(!xmlHttp) xmlHttp=createXmlHttpRequest();
      var send_string="user_id="+username+"&password="+password+"&authCode="+authCode;//+"&fresh="+Math.random();
      xmlHttp.open("POST","login.php",true); 
      xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
      xmlHttp.send(send_string); 
      xmlHttp.onreadystatechange=function(){
        if(xmlHttp.readyState == 4 || xmlHttp.readyState == "complete"){
          var answer=xmlHttp.responseText;
          alert(answer)
          document.getElementById('codefail').style.display="block"
          // if(answer=="ok"){
          //   alert("ok")
          //   window.location.href="index.php";
          // }
          // else if(answer == "codefail"){
          //   alert("codefail")
          //   document.getElementById('codefail').style.display="block"
          // }
          // else if(answer == "fail"){
          //   alert("fail")
          //   document.getElementById("fail").style.display="block"
          // }
        }
      }
    }
  }
</script>  
</head>

<body>

  <div class="container">
    <?php 
      // //如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
      // if(!isset($_SESSION['user_id'])){
          if($_SERVER['REQUEST_METHOD']=="POST"){//用户提交登录表单时执行如下代码
            // if(isset($_SESSION['submit'])){  
              $authCode = $_POST["authCode"];
              $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
              $user_id = mysqli_real_escape_string($dbc,trim($_POST['user_id']));
              $user_password = mysqli_real_escape_string($dbc,trim($_POST['password']));
              if(!empty($user_id) && !empty($user_password)){ //user_id 和 user_password 不为空
                if($authCode != $_SESSION['VCODE']){ //验证码错误
                  $response = "codefail";
                }
                else{ //验证码正确
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
                    $response = "ok";
                  }
                  else{//若查到的记录不对，则设置错误信息
                    $response = 'fail';
                  }
                }
              }else{
                  $response = 'empty';
              }
              echo $response;
          }
      // }
    ?>
    <div class="alert alert-danger" style="display:none" id="codefail">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>
        Authetication code is wrong!!!
      </h4> <strong>please check, then try again.</strong></a>
    </div>

    <div class="alert alert-danger" style="display:none" id="fail">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4>
        User ID or password is wrong!!!
      </h4> <strong>please check, then try again.</strong></a>
    </div>

    <form class="form-signin" role="form">
      <h2 class="form-signin-heading">Please Sign In</h2>
      <input type="text" class="form-control" placeholder="User ID" name="user_id" id="user_id" required autofocus value="<?php if(!empty($user_id)) echo $user_id; ?>">
      <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
      <input type="text" class="form-control" placeholder="Checkcode" name="authCode" id="authCode" onfocus='clearX()' required>
      <img id="vcode" src="yz.php" alt="Another one" onclick="getVCode()"/> 
      <a href="#" onclick="getVCode()">Another One</a>
      <label class="checkbox">
        <input type="checkbox" value="remember-me">Remember me</label>
      <button class="btn btn-primary" id="lBTN" name='submit' onclick="login()">Sign In</button>
      <!-- <button type="button" class="btn btn-lg btn-deflaut btn-block" href="#">Find password</button> -->
    </form>
  </div>
  <!-- /container -->

  <!-- Bootstrap core JavaScript
    ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
