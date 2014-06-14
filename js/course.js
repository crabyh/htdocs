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
        var usertype = data[data.length-1][0];
        console.log(usertype);
        $(".old").empty();
        if (usertype === "admin" || usertype === "manager") 
            $("#description").parent().append("<td align='center'><small> Action </small></td>");
        for (var row = 0; row < data.length - 1; row++) {
          var newrow = document.createElement("tr");
          var rowData = data[row];
          $(newrow).addClass("old");
          var result = "";
          for (var i = 0; i < 4; i++) {
            result += "<td align='center' id='" + i + "'><small>" + rowData[i] + "</small></td>\n";
          };
          result += "<td align='center'><a type='button' class='btn btn-sm btn-info' href='course_info.php?course_id=" + rowData[0] + "'>More</a></td>\n";
          if (usertype === "admin" || usertype === "manager") {
            result += "<td align='center'><button class='btn btn-sm btn-danger del' data-toggle='modal' data-target='#warnModal' id='del" + i + "'>Delete</button></td>\n";
          }
          $(newrow).append(result);
          $(newrow).insertAfter( $("#tableHead") );
          if (keyword) { 
            $("#res").show(); 
            $("#prompt").hide();
            $("#table").show();
          }else{
            $("#res").hide();
          }
        } //end foreach
        $(".del").bind("click",function(event){
          event.preventDefault();
          var delcid = $(this).parent().siblings("#0").children().html();
          var delid = $(this).attr("id");
          $("#deleteBTN").mousedown(function(){
            $.ajax({
              type: "POST",
              url: "course_select_php.php",
              data: "delcid=" + delcid,
              dataType: "json",
              success: function(data){
                if (data['res'] === "delSuccess") {
                  $("#"+delid).parent().parent().remove();
                }
                else $("#failModal").show();
              }
            });// end of ajax
          }) //end of mousedown
        }) //end of bind click
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

  $("#editBTN").click(function(){
    $("#former").hide();
    $("#latter").show();
    $(this).hide();
  });

  $("#submitBTN").click(function(event){
    event.preventDefault();
    var cid = $("#cid").val();
    var cname = $("#cname").val();
    var cdept = $("#cdept").val();
    var credit = $("#credit").val();
    var cintro = $("#cintro").val();
    $.ajax({
      type: "POST",
      url: "course_info_php.php",
      data: "cid="+ cid + "&cname=" + cname + "&cdept=" + cdept + "&credit=" + credit + "&cintro=" + cintro,
      success: function(){
        $("#p_cid").text(cid);
        $("#p_cname").text(cname);
        $("#p_cdept").text(cdept);
        $("#p_credit").text(credit);
        $("#p_cintro").text(cintro);
        $("#latter").hide();
        $("#former").show();
        $("#editBTN").show();
        $("#success").show();
      },
      error: function(){
        $("#fail").show();
      }
    });
  });

  $("#resetBTN").click(function(event){
    event.preventDefault();
    var cid = $("#cid").val();
    $.ajax({
      type: "GET",
      url: "course_info_php.php",
      data: "cid=" + cid,
      dataType: "json",
      success: function(data){
        var cname = data[0][1];
        var cdept = data[0][2];
        var credit = data[0][3];
        var cintro = data[0][4];
        $("#cname").val(cname);
        $("#cdept").val(cdept);
        $("#credit").val(credit);
        $("#cintro").val(cintro);
      }
    })
  })

})
