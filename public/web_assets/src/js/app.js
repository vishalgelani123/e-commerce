gsap.registerPlugin(ScrollTrigger);

$(".animFade").each(function(){
    gsap.fromTo($(this), {
      autoAlpha: 0   
    },{
      scrollTrigger: {
        trigger: $(this),
        start: "top 90%",
      },
      duration: 1,   
      autoAlpha: 1    
    });
  });
  
$(".animLeft").each(function(){
    gsap.fromTo($(this), {
      autoAlpha: 0,
      x: -100,
      y: 0
    },{
      scrollTrigger: {
        trigger: $(this),
        start: "left 90%",
      },
      duration: 1,   
      autoAlpha: 1, 
      x : 0,
    });
  });
  
  
$(".animRight").each(function(){
    gsap.fromTo($(this), {
      autoAlpha: 0,
      x: 100,
      y: 0
    },{
      scrollTrigger: {
        trigger: $(this),
        start: "right 90%",
      },
      duration: 1,   
      autoAlpha: 1, 
      x : 0,
    });
  });
  
  $(".animTop").each(function(){
    gsap.fromTo($(this), {
      autoAlpha: 0, 
      y:60
    },{
      scrollTrigger: {
        trigger: $(this),
        start: "top 90%",
      },
      stagger:0.2,
      duration: 1,   
      autoAlpha: 1,
      y:0
    });
  });

  
  var myLink = '';
  $('li.tabLink').on('click', function () {   
    //alert("Hi");
          
      var $this = $(this);
      $this.find('a').addClass("active");
      $this.siblings().find('a').removeClass("active");
      $this.parents().siblings().find("li").removeClass("active");
      myLink = $this.data('link');
      console.log($this.data('link'));
        
      $('.contentBox [data-content="' + myLink + '"]').stop().fadeIn();
      $('.contentBox').children().not('[data-content="' + myLink + '"]').stop().hide();
  });
  
// Mega Menu

function dropDown(){
  var wWidth = $(window).width();
  if(wWidth < 1200){
    $(".hasMenu > a").on("click", function(e){
      e.preventDefault();
      $(this).parent().siblings().removeClass("active-dropDown").find(".mega-menu").slideUp();
      $(this).parent().toggleClass("active-dropDown");
      $(this).parent().find(".mega-menu").slideToggle();
    });
  }else{
    $(".hasMenu > a").off("click");
  }
}

dropDown();

function menuPos(){
  $(".mega-menu").each(function(){
    $(this).css("left", - ($(this).parent().offset().left)); 
  })
}
menuPos();

$(window).on("load resize", menuPos);

$(".main-nav>ul>li>a").on("mouseover", function(){
  menuPos();
});

// $(window).on("resize", function(){
//   if($(".mega-menu").length){
//     $(".mega-menu").css("left", - ($(".mega-menu").parent().offset().left));  
//   }  
//   dropDown();
// });


// Toggle Mobile Menu
$(".hamburger").on("click",function(event) {
  $(this).toggleClass("h-active");
  $("html").toggleClass("menu-active");
});

$(document).on("keyup", function(e) {
    if (e.keyCode === 27) {
        $(".nav-active .hm").trigger("click");
    }
});

$(window).on("resize", function(){
  if($(window).width() > 1199){
    $(".menu-active .hamburger").trigger("click");
  }
});


// Active header

var offerH = $(".offerBar").outerHeight();
//alert(offerH);

// var activeHeader = function() {
//   var winPos = $(window).scrollTop();
//   if (winPos > offerH) {
//     $(".header-main").addClass("active");
//     $("main").addClass("active");
//   } else {
//     $(".header-main").removeClass("active");
//     $("main").removeClass("active");    
//   }
// };

var activeHeader = function() {
  var winPos = $(window).scrollTop();
  if (winPos > 200) {
    $(".header-main").addClass("active");
    $("main").addClass("active");
  } else {
    $(".header-main").removeClass("active");
    $("main").removeClass("active");    
  }
};




activeHeader();
$(window).scroll(function() {
  activeHeader();
});

$(".searchLink").on('click', function(){
  $(".searchBar").stop().slideToggle();
});

var detailH = $('.detailColumn').outerHeight();
//alert(detailH);
headH = $(".header-main").outerHeight();
//console.log(headH);

var dt = ScrollTrigger.create({
  trigger: ".detailBigimg",
  start: function(){    
    var headerH = $(".header-main").outerHeight();
    //console.log(headerH+"px top");
    return -headerH+"px top";
  },
  end: "bottom bottom",
  pin: ".detailBigimg",
  end: function(){
    var hh = $(".detailColumn").height() - $(".detailBigimg").height() +35;
    return hh;
  }
});
ScrollTrigger.matchMedia({
  "(min-width: 992px)": function() {     
    dt.enable();
  },      
  "(max-width: 991px)": function() {     
    dt.disable();
  }      
});


var lt = ScrollTrigger.create({
  trigger: ".listFilters",
  start: function(){    
    var headerH = $(".header-main").outerHeight();
    //console.log(headerH+"px top");
    return -headerH+"px top";
  },
  pinSpacing: false,
  pin: ".listFilters",
  end: function(){
    //var pl = $(".proList").height();
    var pl = $(".proList").height() - $(".listFilters").height();
    return pl;
  }  
}); 


// var st = ScrollTrigger.create({
//   trigger: ".pDetailBox",
//   start: function(){    
//     var headerH = $(".header-main").outerHeight();
//     //console.log(headerH+"px top");
//     return -headerH+"px top";
//   },
//   pinSpacing: false,
//   pin: ".pDetailBox",
//   end: function(){
//     //var pl = $(".proList").height();
//     var ts = $(".detailBigimg").height() - $(".pDetailBox").height();
//     return ts;
//   }  
// }); 

//console.log(lt.vars.start());

$(window).on("load", function(){
  ScrollTrigger.refresh(true);
});

$(".shopping-icons li.active").on('click',function(e){
  $(this).find('.accountMenu').toggleClass('showMenu');
  e.stopPropagation();
});

$(window).on('click',function(e){
  $('.accountMenu').removeClass('showMenu');
});

$(".accountMenu").css("top", headH);

$(".filterBox li a").on('click', function(){
  //alert("Hi");
  $(this).toggleClass("active");
  $(this).next(".filOption").slideToggle();
  $(this).parent().siblings().find(".filOption").slideUp();
  $(this).parent().siblings().find(".active").removeClass("active");
});

$(".proInfo li h3").on('click', function(){
  $(this).next(".content").slideToggle();
  $(this).toggleClass("active");
  $(this).parent().siblings().find(".content").slideUp();
  $(this).parent().siblings().find("h3").removeClass("active");
});