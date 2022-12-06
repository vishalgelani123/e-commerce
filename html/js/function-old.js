(function ($) {

	// Preloader Image
		$(document).ready(function() {
			$('#loader').fadeOut('slow',function(){$(this).remove();});
		}); 
	
	// Sticky Header 
	  $(window).scroll(function() {
			if($('.header').length){
				var mainHeader = $('.header').height();
				var windowpos = $(window).scrollTop();
				if (windowpos >= mainHeader) {
					$('.header-sticky').addClass('sticked');
					
				} else {
					$('.header-sticky').removeClass('sticked');
					
				}
			}
	   });

	// Respoonsive Menu		  
		  $( ".navbar-nav li" ).click(function(event) {
			// stop bootstrap.js to hide the parents
			event.stopPropagation();
			// hide the open children
			$( this ).find(".sub-menu").removeClass('open');
			// add 'open' class to all parents with class 'dropdown-submenu'
			$( this ).parents(".sub-menu").addClass('open');
			// this is also open (or was)
			$( this ).toggleClass('open');
		});
		
		$(".mega-menu-item li a").hover(
			function () {
			  $(this).addClass("result_hover");
			  $('.mega-menu-column-large').addClass("mega-menu-active");
			},
			function () {
			  $(this).removeClass("result_hover");
			  $('.mega-menu-column-large').removeClass("mega-menu-active");
			}
		  );
	
	// Secarh Section
	  $('.search-icon').click(function(){    
		$('.search-wrapper').toggleClass('open');  
		 $('body').toggleClass('search-wrapper-open');
	  });
	   $('.search-cancel').click(function(){    
		$('.search-wrapper').removeClass('open');  
		$('body').removeClass('search-wrapper-open');
	  });
	
	// Scrool Function Back to  Top And Transparent Header
	   $(window).scroll(function() {    
			var scroll = $(window).scrollTop();
			if(scroll >= 100) {
				$('.scroll-top').fadeIn(300);
				$(".header-fixed").addClass("fix");
				$(".header-transparent").addClass("transparency");
			} else {
				$('.scroll-top').fadeOut(300);
				$(".header-fixed").removeClass("fix");
				$(".header-transparent").removeClass("transparency");
			}
	  });
	// Scrool Function Back to  Top   
	  $('.scroll-top').click(function(){ 
		 $("html, body").animate({ scrollTop: 0 }, 600); 
		 return false; 
	  });
	  
		
	//Animated	
		 new WOW().init();	 

	// Slider Carousel
	$('.slider-carousel').slick({ 		
		arrows: false,
		dots: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		swipe: true,
		//fade: true,
		cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
		touchThreshold: 100,
		pauseOnHover: false,
		touchMove: true,
		draggable: true,
		autoplay: true,
		pauseOnHover: true,
		speed: 500,
		autoplaySpeed: 8e3,
		prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
		nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
	});

	
	// Announcement Carousel
	$('.header-announcement-carousel').slick({ 
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1, 
		autoplay: true,
		autoplaySpeed: 3000, 
		pauseOnHover:false,
		arrows: false,
		prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
		nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',	
		});	

	// Testimonial Carousel
	$('.testimonial-carousel').slick({ 
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1, 
		autoplay: true,
		autoplaySpeed: 3000, 
		pauseOnHover:false,
		arrows: true,
		prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
		nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',	
		});	
	
	  // Product Category Carousel
	  $('.product-category-carousel').slick({ 
		dots: false,
		infinite: true,
		speed: 300,
		slidesToShow: 3,
		slidesToScroll: 1, 
		cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
		autoplay: false,
		autoplaySpeed: 3000, 
		pauseOnHover:false,
		centerMode: true,
  		centerPadding: '0px',
		arrows: true,
		prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
		nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
		 responsive: [
		  {
			breakpoint: 1024,
			settings: {
			  slidesToShow: 3,
			}
		  },
		  {
			breakpoint: 768,
			settings: {
			  slidesToShow: 2,
			}
		  },
		  {
			breakpoint: 600,
			settings: {
			  slidesToShow: 1,   
			}
		  } 
		]
		});
	
	
	// Product Carousel
	   $('.product-carousel').slick({ 
		  dots: false,
		  infinite: true,
		  speed: 300,
		  slidesToShow: 4,
		  slidesToScroll: 1, 
		  autoplay: true,
		  autoplaySpeed: 3000, 
		  pauseOnHover:false,
		  arrows: true,
		  prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
		  nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
		   responsive: [
			{
			  breakpoint: 991,
			  settings: {
				slidesToShow: 3,
			  }
			},
			{
			  breakpoint: 767,
			  settings: {
				slidesToShow: 2,
			  }
			},
			{
			  breakpoint: 575,
			  settings: {
				slidesToShow: 1,   
			  }
			} 
		  ]
		});

		// instagram Carousel
		$('.instagram-carousel').slick({ 
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 1, 
			autoplay: true,
			autoplaySpeed: 3000, 
			pauseOnHover:false,
			arrows: true,
			prevArrow: '<div class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>',
			nextArrow: '<div class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>',
				responsive: [
				{
				breakpoint: 991,
				settings: {
					slidesToShow: 3,
				}
				},
				{
				breakpoint: 767,
				settings: {
					slidesToShow: 2,
				}
				},
				{
				breakpoint: 575,
				settings: {
					slidesToShow: 1,   
				}
				} 
			]
			});

		
		// Product Gallery
		$('.product-gallery-slider').slick({
			slidesToShow: 1,
			slidesToScroll: 1,
			arrows: false,
			fade: true,
			cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
			touchThreshold: 100,
			pauseOnHover: false,
			touchMove: false,
			draggable: false,
			autoplay: false,
			pauseOnHover: true,
			adaptiveHeight: true,
			asNavFor: '.product-gallery-thumbs'
		  });
		  $('.product-gallery-thumbs').slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			asNavFor: '.product-gallery-slider',
			vertical: true,
  			verticalSwiping: true,
			dots: false,
			arrows: false,
			//centerMode: true,
			//centerPadding: '0px',
			focusOnSelect: true,
			responsive: [
				{
				breakpoint: 767,
				settings: {
					vertical: false,
  					verticalSwiping: false,
				}
				},	
			]
		  });		

		// Load popup
		$(window).on('load',function(){
			$('#newsletter-popup').modal({
				   backdrop: 'static',
				   //keyboard: false,
				   show: true
			   }); 
		   });
		   	
		// display Product View
		$('.product-display-mode #grid').click(function(){    
			$('ul.products').addClass('columns-3');  
			$('ul.products').removeClass('columns-4'); 
			$('.product-display-mode #grid').toggleClass('active');  
			$('.product-display-mode #grid_large').toggleClass('active');  			
		});
		$('.product-display-mode #grid_large').click(function(){    
			$('ul.products').addClass('columns-4');  
			$('ul.products').removeClass('columns-3'); 	
			$('.product-display-mode #grid').toggleClass('active');  
			$('.product-display-mode #grid_large').toggleClass('active');  		
		});

		// Widget Open hide
		$('.filter-sidebar .widget-title').click(function(){  
			$( this ).toggleClass('open');	
			$( this ).parents(".widget").toggleClass('open');		
		});		

		
		// Quantity Button plus minus		 
		$(".qty-btn").off('click.changeQuantity').on('click.changeQuantity', function(e) {
			e.preventDefault();
			e.stopPropagation();	
			var oldValue = $('.qty').val(),
				newVal = 1;
			var totalinvent = $('.qty').attr('maxlength');		
	
			if($(this).hasClass('inc')) {
			if(parseInt(oldValue) < parseInt(totalinvent)) {
			newVal = parseInt(oldValue) + 1;
			}
			}
			else if(oldValue > 1) {
			newVal = parseInt(oldValue) - 1;
			}
	
			$(".qty").val(newVal);	
			
		});	

		// Edit address
		$(".enable-value").click(function() {      
			$(".account-form .form-control, .account-form  .btn").attr("disabled", false);		
			$(".enable-value, .address-content").addClass('d-none');
			$(".disable-value,.account-form .buttons, .address-form").removeClass('d-none');
		});
		$(".disable-value").click(function() {
			$(".account-form .form-control, .account-form  .btn").attr("disabled", true);
			//$(".account-form .buttons").toggleClass('open');
			$(".enable-value, .address-content").removeClass('d-none');
			$(".disable-value, .account-form .buttons, .address-form").addClass('d-none');
		});

		$('#new-address .cancel').click(function(){  
			$('#new-address').toggleClass('show'); 
		  
		 });

		// Login/Signup PopUp
		 $('.account-link.register').click(function(){  
			$('.modal-register').removeClass('d-none'); 
			$('.modal-login').addClass('d-none');		  
		 });
		 $('.account-link.login').click(function(){  
			$('.modal-register').addClass('d-none'); 
			$('.modal-login').removeClass('d-none');		  
		 });


		 // Payment Option
		//  $('input[name="payment_method"]').on('change', function() {
		// 	if (this.value == 'paypal') {
		// 		$('.payment-box-cod').hide();
		// 		$('.payment-box-paypal').show();
		// 	} else {
		// 		$('.payment-box-cod').show();
		// 		$('.payment-box-paypal').hide();
		// 	}
		// });
			
	}(jQuery));