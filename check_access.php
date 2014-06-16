<?php if(!isset($_SESSION['user_id'])): ?>
	<script type="text/javascript"> 
	setTimeout(window.location.href="index.php?access=illegal",3); 
	</script>
<?php else: 
	include 'connectvars.php';
	$user_id = $_SESSION['user_id'];
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	$query = "SELECT * FROM accounts WHERE user_id ='$user_id'";
	$data = mysqli_query($dbc,$query);
	if (mysqli_num_rows($data) == 1) {
		$result = mysqli_fetch_array($data);
		$usertype =  $result['usertype'];
		$_SESSION['usertype'] = $usertype;
	}
	endif 
?>
