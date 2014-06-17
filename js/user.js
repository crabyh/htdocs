$(document).ready(function(){

  var userSuccess = function(data){
          var keyword = $("#userKeyword").val();
          switch (data["res"]) {
            case "none":
              $("#res").show();
              $("#prompt").html("No query conditions!");
              $("#prompt").show();
              $("#table").hide();
              $(".old").remove();
              if (!keyword) { $("#res").hide() };
              break;
            case "noSeltype":
              $("#prompt").html("No query type!\nPlease choose one query type!");
              $("#prompt").show();
              $("#table").hide();
              $("#res").show();
              $(".old").remove();
              if (!keyword) { $("#res").hide() };
              break;
            case "fail":
              $("#res").show();
              $("#prompt").html("No records!");
              $("#prompt").show();
              $("#table").hide();
              $(".old").remove();
              if (!keyword) { $("#res").hide() };
              break;
            case "noKeyword":
              $("#res").show();
              $("#prompt").html("No keyword!\nPlease input some keywords!");
              $("#prompt").show();
              $("#table").hide();
              $(".old").remove();
              if (!keyword) { $("#res").hide() };
              break;
            default:
              $(".old").remove();
              $.each(data, function(row){
                var newrow = document.createElement("tr");
                var rowData = data[row];
                $(newrow).addClass("old");
                var result = "";
                for (var i = 0; i < 8; i++) {
                  result += "<td align='center' id='" + i + "'><small>" + rowData[i] + "</small></td>\n";
                };
                result += "<td align='center'><a type='button' class='btn btn-sm btn-info' href='user_info.php?user_id=" + rowData[0] + "'>More</a></td>\n";
                result += "<td align='center'><button type='button' class='btn btn-sm btn-danger del' data-toggle='modal' data-target='#warnModal' id='del" + row + "'>Delete</button></td>\n";
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
              $(".del").bind("click",function(event){
                event.preventDefault();
                var deluid = $(this).parent().siblings("#0").children().html();
                var delid = $(this).attr("id");
                $("#deleteBTN").mousedown(function(){
                  $.ajax({
                    type: "POST",
                    url: "user_select_php.php",
                    data: "deluid=" + deluid,
                    dataType: "json",
                    success: function(data){
                      if (data['res'] === "delSuccess") {
                        $("#"+delid).parent().parent().remove();
                      }
                      else $("#failModal").show();
                    }
                  }); //end of ajax
                }) // end of mousedown
              }) // end of bind click
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

  $("button#editBTN").click(function(){
    $("#former").hide();
    $("#latter").show();
    $("#editBTN").hide();
    $("#upload").show();
    $.get("user_info_php.php", function(data){
      if (data === "admin") {
        $(".admin").removeAttr("disabled");
        $("#passwordInput").show();
      }else if (data === "manager") {
        $(".manager").removeAttr("disabled");
      }
    })
  });
  
  $("button#doneBTN").click(function(event){
    event.preventDefault();
    var newphone = $("#phonenum").val();
    var newemail = $("#emailaddr").val(); 
    var user_id = $("#user_id").val();
    var password = $("#password").val();
    $.ajax({
      type: "POST",
      url:"user_info_php.php",
      data: "phone=" + newphone + "&email=" + newemail + "&user_id=" + user_id + "&password=" + password,  
      success: function(data){
        $('#phone_label').text(newphone);
        $('#email_label').text(newemail);
        $("#password").text(password);
        $("form#former").show();
        $("form#latter").hide();
        $("#success").show();
        $("#editBTN").show();
        $("#upload").show();
      },
      error: function(){
        $("#fail").show()
      }
    }); // end ajax
  }); //end click

  $("#resetBTN").click(function(event){
    event.preventDefault();
    var user_id = $("#user_id").val();
    $.ajax({
      type: "GET",
      url: "user_info_php.php",
      data: "user_id=" + user_id,
      dataType: "json",
      success: function(data){
        var phone = data[0][6];
        var email = data[0][7];
        $("#phonenum").val(phone);
        $("#emailaddr").val(email);
      }
    })
  })
  
})