<?php
if(!isset($_SESSION['user_id']))
	echo'
	<script type="text/javascript"> 
	setTimeout(window.location.href="illegal_access.php",3); 
	</script>';
?>