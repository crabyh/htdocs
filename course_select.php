<?php session_start();?>
<html lang="en">

<!-- checking illegal access -->
<?php include 'check_access.php'; ?>

<!-- accessing database -->
<?php 
require_once 'connectvars.php'; 
$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$user_id = mysqli_real_escape_string($dbc,trim($_SESSION['user_id']));
$query = "SELECT * FROM user_info WHERE user_id = '$user_id'";
$data = mysqli_query($dbc,$query);
?>

<!-- include head file-->
<head> 
  <?php include 'header.php'; ?>  
  <script type="text/javascript">
  $(document).ready(function(){

    $("#keyword").keyup(function(){
      var seltype = $("#seltype").val();
      var keyword = $(this).val();
      var order = $("#order").val();

      var myFunction = function(data){
          switch (data["res"]) {
            case "none":
              $("#res").show();
              $("#prompt").html("No query conditions!");
              $("#table").hide();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "noSeltype":
              $("#prompt").html("No query type!\nPlease choose one query type!");
              $("#table").hide();
              $("#res").show();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "fail":
              $("#res").show();
              $("#prompt").html("No records!");
              $("#table").hide();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "noKeyword":
              $("#res").show();
              $("#prompt").html("No keyword!\nPlease input some keywords!");
              $("#table").hide();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            default:
              $(".old").empty();
              $.each(data, function(row){
                var newrow = document.createElement("tr");
                var rowData = data[row];
                $(newrow).addClass("old");
                var result = "";
                for (var i = 0; i < 4; i++) {
                  result += "<td align='center'><small>" + rowData[i] + "</small></td>\n";
                };
                result += "<td align='center'><a type='button' class='btn btn-sm btn-default' href='course_info.php?course_id=" + rowData[0] + "'>More</a></td>\n";
                result += "<td align='center'><a type='button' class='btn btn-sm btn-default' href=''>Delete</a></td>\n";
                $(newrow).append(result);
                $(newrow).insertAfter( $("#tableHead") );
                if (keyword) { 
                  $("#res").show(); 
                  $("#prompt").hide();
                  $("#table").show();
                }else{
                  $("#res").hide();
                }
              }); //end foreach
          }; //end switch
        }

      $.ajax({
        type:"POST",
        url: "course_select_php.php",
        dataType: "json",
        data: "seltype=" + seltype + "&order=" + order + "&keyword=" + keyword,
        success: myFunction, //end success function
      }) //end ajax
    }) // end keyup
    
  })
  </script>
</head>

<body>
  <div id="wrap">

    <!-- Fixed navbar -->
    <?php include 'navigation.php'; ?> 

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">  
        <h1> 
          Course Information 
        </h1>      
      </div>

      <div class="panel panel-default" id="queryForm"> <!-- 查询框 -->
        <div class="panel-heading">
        <p></p>
          <!-- 查询表单 -->
          <form>
            <div class="input-group">
              <span class="input-group-addon">
                <select name="seltype" id="seltype" class="selectpicker">
                  <option value="">Query By</option>
                  <!-- <option value="all">All</option> -->
                  <option value="cid">Course ID</option>
                  <option value="cname">Course Name</option>
                  <option value="cdepartment">Department</option>
                  <option value="credit">Credit</option>
                </select>
              </span>
              <span class="input-group-addon">
                <select name="" id="order">
                  <option value="">Order By</option>
                  <!-- <option value="all">All</option> -->
                  <option value="cid">Course ID</option>
                  <option value="cname">Course Name</option>
                  <option value="cdepartment">Department</option>
                  <option value="credit">Credit</option>
                </select>
              </span>
              <span>
                <input type="text" placeholder="Keyword" class="form-control" name="keyword" id="keyword">
              </span>
            </div>
          </form>
        </div> 

        <div id="res" style="display: none">
          <h4 align="center">Search Results</h4>
          <p id="prompt" align="center"></p>
          <table class="table table-striped" id="table">
            <tr id="tableHead">
            <td align='center'><small> Course ID </small></td>
            <td align='center'><small> Course Name </small></td>
            <td align='center'><small> Department </small></td>
            <td align='center'><small> Credit </small></td>
            <td align='center'><small> Description </small></td>
            <td align='center'colspan='3'><small> Action </small></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

          
        <!-- </div> -->
   

  <!-- clear user_info Session -->

  <!-- page footer -->
  <?php include"footer.php"; ?>

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="http://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
</body>
</html>