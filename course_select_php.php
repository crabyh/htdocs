<?php
    session_start();
    if(isset($_POST["seltype"]) || isset($_POST["keyword"]) || isset($_POST["order"]))
    {
        require_once 'connectvars.php'; 
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        if (isset($_POST['seltype']) && $_POST['seltype']) {  //有指定query的type seltype
            $seltype = $_POST["seltype"];
            if (isset($_POST['order']))  // 指定order
                $order = $_POST['order'];
            else 
                $order = false;
            if($seltype == "all") //选出所有数据，不需要keyword
            {
                if ($order)  //有排序选项 
                  $sql='SELECT * FROM course_info ORDER BY '.$order.' DESC;';
                else 
                  $sql = 'SELECT * FROM course_info;';
            }
            else { // 根据seltype来筛选，需要keyword
                if (isset($_POST['keyword'])) {
                    $keyword = $_POST["keyword"];
                    if ($order) 
                      $sql = 'SELECT * FROM course_info WHERE '.$seltype.' LIKE "%'.$keyword.'%" ORDER BY '.$order.' DESC;';
                    else 
                      $sql = 'SELECT * FROM course_info WHERE '.$seltype.' LIKE "%'.$keyword.'%";';
                }
                else{
                    $response = array('res' => "noKeyword"); 
                    echo "noKeyword";
                }
            }
            $arr = mysqli_query($dbc, $sql);  //执行SQL
            if(mysqli_num_rows($arr)){ //如果从数据库中取出数据
                while ($row = mysqli_fetch_row($arr)) {
                    $res[] = $row;
                }
                $res[] = array($_SESSION['usertype']);
                echo json_encode($res);
            } // end IF 取数据
            else {
                $response = array('res' => "fail");
                echo json_encode($response);
                // header("002");
            }
        }
        else {
            $response = array('res' => "noSeltype");
            echo json_encode($response);
        }
    } 
    else if(isset($_POST['delcid'])) {
        $delcid = $_POST['delcid'];
        require_once 'connectvars.php'; 
        $dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $query = "DELETE FROM course_info WHERE cid = '$delcid';";
        $data = mysqli_query($dbc, $query);
        if ($data) {
            $response = array('res' => 'delSuccess');
            echo json_encode($response);
        }
        else {
            $response = array('res' => 'delFail');
            echo json_encode($response);
        }
    } 
    else {
        $response = array('res' => "none");
        echo json_encode($response);
    }
?> 