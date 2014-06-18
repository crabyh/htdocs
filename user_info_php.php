<?php
  session_start();
  require_once 'connectvars.php'; 
  $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  $data = false;
  if(isset($_POST['user_id'])) { 
    $data = FALSE;
    $user_id = $_POST['user_id'];
    $usertype = $_SESSION['usertype'];
    if ($usertype == "admin") {
      if($_POST['password']!=''){
        $newpassword = $_POST['password'];
        $md5_newpassword = md5("$newpassword");
        $query = "UPDATE accounts SET password = '$md5_newpassword' WHERE user_id = '$user_id'";
        $data = mysqli_query($dbc,$query);
      }
    }
    if ($usertype == "admin" || $usertype == "manager") {
      if($_POST['username']!=''){
        $username = $_POST['username'];
        $query = "UPDATE user_info SET username = '$username' WHERE user_id = '$user_id'";
        $data = mysqli_query($dbc,$query);
      }
      if($_POST['enroll_time']!=''){
        $enroll_time = $_POST['enroll_time'];
        $query = "UPDATE user_info SET enroll_time = '$enroll_time' WHERE user_id = '$user_id'";
        $data = mysqli_query($dbc,$query);
      }
      if($_POST['department']!=''){
        $department = $_POST['department'];
        $query = "UPDATE user_info SET department = '$department' WHERE user_id = '$user_id'";
        $data = mysqli_query($dbc,$query);
      }
      if($_POST['gender']!=''){
        $gender = $_POST['gender'];
        $query = "UPDATE user_info SET gender = '$gender' WHERE user_id = '$user_id'";
        $data = mysqli_query($dbc,$query);
      }
      if($_POST['birthday']!=''){
        $birthday = $_POST['birthday'];
        $query = "UPDATE user_info SET birthday = '$birthday' WHERE user_id = '$user_id'";
        $data = mysqli_query($dbc,$query);
      }
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
  else if(isset($_GET['user_id'])) { //用于reset 
    $user_id = $_GET['user_id'];
    $query = "SELECT * FROM user_info WHERE user_id ='$user_id'";
    $data = mysqli_query($dbc, $query);
    if ($data) {
      $result = mysqli_fetch_row($data);
      echo json_encode($result);
    }
  }
  else if(isset($_GET['userid'])) { //按下editBTN之后
    $userid = $_GET['userid'];
    $query = "SELECT * FROM accounts WHERE user_id ='$userid'";
    $data = mysqli_query($dbc, $query);
    if ($data) {
      $result = mysqli_fetch_array($data);
      $usertype = $result['usertype'];
      $UserTypes[] = $_SESSION['usertype'];
      $UserTypes[] = $usertype;
      echo json_encode($UserTypes); //返回当前登录的用户类型和显示个人信息的登录类型
    }
  }
  else echo $_SESSION['usertype']; 

?>