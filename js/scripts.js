$(document).ready(function(){

  var courseSuccess = function(data){
          var keyword = $("#courseKeyword").val();
          switch (data["res"]) {
            case "none":
              $("#res").show();
              $("#prompt").html("No query conditions!");
              $("#prompt").show();
              $("#table").hide();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "noSeltype":
              $("#prompt").html("No query type!\nPlease choose one query type!");
              $("#prompt").show();
              $("#table").hide();
              $("#res").show();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "fail":
              $("#res").show();
              $("#prompt").html("No records!");
              $("#prompt").show();
              $("#table").hide();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "noKeyword":
              $("#res").show();
              $("#prompt").html("No keyword!\nPlease input some keywords!");
              $("#prompt").show();
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
                result += "<td align='center'><a type='button' class='btn btn-sm btn-info' href='course_info.php?course_id=" + rowData[0] + "'>More</a></td>\n";
                result += "<td align='center'><a type='button' class='btn btn-sm btn-danger' href=''>Delete</a></td>\n";
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

  $("#courseKeyword").keyup(function(){
    var seltype = $("#seltype").val();
    var keyword = $(this).val();
    var order = $("#order").val();

    $.ajax({
      type:"POST",
      url: "course_select_php.php",
      dataType: "json",
      data: "seltype=" + seltype + "&order=" + order + "&keyword=" + keyword,
      success: courseSuccess, //end success function  
    }) //end ajax
  }) // end keyup

  var userSuccess = function(data){
          var keyword = $("#userKeyword").val();
          switch (data["res"]) {
            case "none":
              $("#res").show();
              $("#prompt").html("No query conditions!");
              $("#prompt").show();
              $("#table").hide();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "noSeltype":
              $("#prompt").html("No query type!\nPlease choose one query type!");
              $("#prompt").show();
              $("#table").hide();
              $("#res").show();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "fail":
              $("#res").show();
              $("#prompt").html("No records!");
              $("#prompt").show();
              $("#table").hide();
              $(".old").empty();
              if (!keyword) { $("#res").hide() };
              break;
            case "noKeyword":
              $("#res").show();
              $("#prompt").html("No keyword!\nPlease input some keywords!");
              $("#prompt").show();
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
                for (var i = 0; i < 8; i++) {
                  result += "<td align='center'><small>" + rowData[i] + "</small></td>\n";
                };
                result += "<td align='center'><a type='button' class='btn btn-sm btn-info' href='user_info.php?user_id=" + rowData[0] + "'>More</a></td>\n";
                result += "<td align='center'><a type='button' class='btn btn-sm btn-danger' href=''>Delete</a></td>\n";
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

  $("#userKeyword").keyup(function(){
    var seltype = $("#seltype").val();
    var keyword = $(this).val();
    var order = $("#order").val();

    $.ajax({
      type:"POST",
      url: "user_select_php.php",
      dataType: "json",
      data: "seltype=" + seltype + "&order=" + order + "&keyword=" + keyword,
      success: userSuccess, //end success function  
    }) //end ajax
  })
  
})