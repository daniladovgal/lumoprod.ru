$(".order_closebtn").click(function() {
    $(".order").slideUp(300, function() {
      $(".ordercomplete").css("display","none");
      $(".order_block").css("display","flex");
      $("#ordername").val("");
      $("#orderrel").val("");
      $("#ordercomment").val("");
    });
});


$("#headerbid").click(function(){
    $(".order").slideDown(300);
});

$(".order_btn").click(function(){

   var name = $("#ordername").val();
   var rel = $("#orderrel").val();
   var comment = $("#ordercomment").val();

   var fill = true;

   if (empty(name)) {
      $("#labelname").css("color","red");
      fill = false;
   } else {
      $("#labelname").css("color","black");
   }
   if (empty(rel)) {
      $("#labelrel").css("color","red");
      fill = false;
   } else {
      $("#labelrel").css("color","black");
   }
   if (empty(comment)) {
      $("#labelcomment").css("color","red");
      fill = false;
   } else {
      $("#labelcomment").css("color","black");
   }

   if (fill) {
      $.getJSON('/api/?order.send={"name":"'+name+'","rel":"'+rel+'","comment":"'+comment+'"}', function(ans) {
        if (ans.response == "0") {
           $(".order_block").fadeOut(100, function() {
              $(".ordercomplete").fadeIn(100);
           });
        } else {
          alert("Не удалось отправить заявку, попробуйте позже");
        }
      });

   }
});


 function empty(varr) {
    if (varr == "" || varr == "NULL" || varr == undefined || varr == NaN || varr == "null" || typeof varr == 'undefined') {
      return true;
    } else {
      return false;
    }
 }