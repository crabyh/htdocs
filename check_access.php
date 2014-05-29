<?php
//使用一个会话变量检查登录状态
if(!isset($_SESSION['user_id']))
	header('Location:illegal_access.php');
?>