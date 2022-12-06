function fullWidth(){
    var wWidth = ($(window).width() - $(".containerwidth").width()) / 2;
    $(".hs").css({"margin-left": -wWidth, "width": wWidth});
    $(".fl").css("margin-left", -wWidth);
    $(".fr").css("margin-right", -wWidth);
    $(".flp").css("padding-left", wWidth);
    $(".frp").css("padding-right", wWidth);
   return {
      getEmptyArea: wWidth
    }
  }

  fullWidth();
  $(window).on("resize", function(){
    fullWidth();
  });