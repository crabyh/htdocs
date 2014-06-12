<?php
  require_once 'connectvars.php'; 
  $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  $data = false;
  if($_POST){
    $cid = $_POST['cid'];
    if($_POST['cname']!=''){
      $cname = $_POST['cname'];
      $query = "UPDATE course_info SET cname = '$cname' WHERE cid = '$cid'";
      $data = mysqli_query($dbc,$query);
    }
    if($_POST['cdept']!=''){
      $cdept=$_POST['cdept'];
      $query = "UPDATE course_info SET cdepartment = '$cdept' WHERE cid = '$cid'";
      $data = mysqli_query($dbc,$query);
    }
    if($_POST['credit']!=''){
      $credit=$_POST['credit'];
      $query = "UPDATE course_info SET credit = '$credit' WHERE cid = '$cid'";
      $data = mysqli_query($dbc,$query);
    }
    if($_POST['cintro']!=''){
      $cintro=$_POST['cintro'];
      $query = "UPDATE course_info SET course_intro = '$cintro' WHERE cid = '$cid'";
      $data = mysqli_query($dbc,$query);
    }
  }
  else if($_GET){
    $cid = $_GET['cid'];
    $query = "SELECT * FROM course_info WHERE cid='$cid'";
    $data = mysqli_query($dbc, $query);
    if ($data) {
      $result = mysqli_fetch_all($data);
      echo json_encode($result);
    }
  }

?>