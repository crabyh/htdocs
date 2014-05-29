<?php  
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$query = sprintf("UPDATE table SET phone = '%s'", $_POST["phone"]);
$result = mysqli_query($query)
if (!$result){
  $message = "Failed\n";
  echo "<script type='text/javascript'>alert('failed');</script>";
}
else{
  message = "Success\n";
  echo "<script type='text/javascript'>alert('Success');</script>";
}
?>
