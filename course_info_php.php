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
      echo "1";
    }
    if($_POST['cdept']!=''){
      $cdept=$_POST['cdept'];
      $query = "UPDATE course_info SET cdepartment = '$cdept' WHERE cid = '$cid'";
      $data = mysqli_query($dbc,$query);
      echo "2";
    }
    if($_POST['credit']!=''){
      $credit=$_POST['credit'];
      $query = "UPDATE course_info SET credit = '$credit' WHERE cid = '$cid'";
      $data = mysqli_query($dbc,$query);
      echo "3";
    }
    if($_POST['cintro']!=''){
      $cintro=$_POST['cintro'];
      $query = "UPDATE course_info SET course_intro = '$cintro' WHERE cid = '$cid'";
      $data = mysqli_query($dbc,$query);
      echo "4";
    }
  }

?>