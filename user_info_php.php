<?php
  session_start();
  require_once 'connectvars.php'; 
  $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  $data = false;
  if(isset($_POST['user_id'])) { 
    $data = FALSE;
    $user_id = $_POST['user_id'];
    $usertype = $_SESSION['usertype'];
    if($_POST['password']!=''){
      $newpassword = $_POST['password'];
      $md5_newpassword = md5("$newpassword");
      $query = "UPDATE accounts SET password = '$md5_newpassword' WHERE user_id = '$user_id'";
      $data = mysqli_query($dbc,$query);
    }
    if($_POST['phone']!=''){
      $phone=$_POST['phone'];
      $query = "UPDATE user_info SET phone = '$phone' WHERE user_id = '$user_id'";
      $data = mysqli_query($dbc,$query);
    }
    if($_POST['email']!=''){
      $email=$_POST['email'];
      $query = "UPDATE user_info SET email = '$email' WHERE user_id = '$user_id'";
      $data = mysqli_query($dbc,$query);
    }
    if ($data == TRUE) {
      $data = mysqli_query($dbc, $query);
    }
    echo "$usertype";
  }
  else if(isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM user_info WHERE user_id ='$user_id'";
    $data = mysqli_query($dbc, $query);
    if ($data) {
      $result = mysqli_fetch_all($data);
      echo json_encode($result);
    }
  }
  else echo $_SESSION['usertype'];

?>