<?php
/**同时注销session和cookie的页面*/
//即使是注销时，也必须首先开始会话才能访问会话变量
session_start();
//使用一个会话变量检查登录状态
if(isset($_SESSION['user_id'])){
    //使用内置session_destroy()函数调用撤销会话
    session_unset();
    session_destroy();
}
//同时将各个cookie的到期时间设为过去的某个时间，使它们由系统删除，时间以秒为单位
// setcookie('user_id','',time()-3600);
// setcookie('username','',time()-3600);
?>

<html>
<head>
<script type="text/javascript"> 
//3秒钟之后跳转到指定的页面 
setTimeout(window.location.href="index.php?logout=success",3); 
</script> 
</head>
</html>