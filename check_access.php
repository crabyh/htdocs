<?php if(!isset($_SESSION['user_id'])): ?>
	<script type="text/javascript"> 
	setTimeout(window.location.href="index.php?access=illegal",3); 
	</script>
<?php else: 
	$user_id = $_SESSION['user_id'];
	endif 
?>
