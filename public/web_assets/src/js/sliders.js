//Hero Slider
var heroSlide = new Swiper('.hero-slider', {
    effect: 'fade',
    loop: true,
    speed: 1500,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.hero-slider .sl-next',
        prevEl: '.hero-slider .sl-prev'
    },
    on:{
        init: function () {
          console.log('swiper initialized');
          var rand = Math.floor(Math.random() * this.slides.length);
          this.slideTo(rand, 0, null);
          $(".heroSlider").removeClass("onloadSwiperOpacity");
        },
        slideChange: function (swiper) {
          $('.swiper-slide').find('video').each(function() {
              this.currentTime =  0;         
          });
          //console.log("Hi");
        }
    }
});

var womenSlide = new Swiper('.cproducts-slider', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: false,
    autoplay: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    
    navigation: {
        nextEl: ".cslide .swiper-button-next",
        prevEl: ".cslide .swiper-button-prev"
    },
    breakpoints: {
        1199: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 3,
        },
        450: {
            slidesPerView: 2,
        },
        320: {
            noSwiping: false,
            slidesPerView: 1,
            spaceBetween: 0,
            loop: false
        }
    }
});

var fslide = new Swiper('.fproducts-slider', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: false,
    autoplay: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    
    navigation: {
        nextEl: ".fslide .swiper-button-next",
        prevEl: ".fslide .swiper-button-prev"
    },
    breakpoints: {
        1199: {
            slidesPerView: 4,
        },
        991: {
            slidesPerView: 3,
        },
        450: {
            slidesPerView: 2,
        },
        320: {
            noSwiping: false,
            slidesPerView: 1,
            spaceBetween: 0,
            loop: false
        }
    }
});

var dslide = new Swiper('.dproducts-slider', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: false,
    autoplay: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    
    navigation: {
        nextEl: ".dslide .swiper-button-next",
        prevEl: ".dslide .swiper-button-prev"
    },
    breakpoints: {
        1199: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 3,
        },
        450: {
            slidesPerView: 2,
        },
        320: {
            noSwiping: false,
            slidesPerView: 1,
            spaceBetween: 0,
            loop: false
        }
    }
});

var categorySlide = new Swiper('.category-slider', {
    slidesPerView: 3,
    spaceBetween: 0,
    loop: false,
    autoplay: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: ".sliderWrapper .swiper-button-next",
        prevEl: ".sliderWrapper .swiper-button-prev"
    },
    breakpoints: {
        1199: {
            slidesPerView: 3,
        },
        991: {
            slidesPerView: 3,
        },
        767: {
            slidesPerView: 2,
        },
        575: {
            noSwiping: false,
            slidesPerView: 1,
            spaceBetween: 0,
            loop: false
        }
    }
});


var categorySlide = new Swiper('.category-slider1', {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    speed: 1500,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: ".sliderWrapper .swiper-button-next",
        prevEl: ".sliderWrapper .swiper-button-prev"
    }
});

console.log(fullWidth().getEmptyArea)