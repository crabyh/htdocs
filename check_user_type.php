<!--Check User Type-->
<?php
function CheckUserType($UserType)
{
    if($UserType == 'teacher' and (($_SESSION['usertype'] == 'teacher') or ($_SESSION['usertype'] == 'manager') or ($_SESSION['usertype'] == 'admin')))
    {
    	return 1;
    }
    else if ($UserType == 'manager' and (($_SESSION['usertype'] == 'manager') or ($_SESSION['usertype'] == 'admin')))
    {
    	return 1;
    }
    else if (($UserType == 'admin') and ($_SESSION['usertype'] == 'admin'))
    {
    	return 1;
    }
     else
     {   //当用户类型不正确时，跳转到登录后的首页
     	echo'
		 <script type="text/javascript"> 
		 setTimeout(window.location.href="loged.php",3); 
		 </script>';
     }
}
?>