(function($) {
    "use strict";
    /*===================================================================================*/
/*	OWL CAROUSEL
/*===================================================================================*/
$(document).ready(function () {
    var dragging = true;
    var owlElementID = "#owl-main";

    function fadeInReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").stop().delay(800).animate({ opacity: 0 }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeIn-1, " + owlElementID + " .caption .fadeIn-2, " + owlElementID + " .caption .fadeIn-3").css({ opacity: 0 });
        }
    }

    function fadeInDownReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").stop().delay(800).animate({ opacity: 0, top: "-15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInDown-1, " + owlElementID + " .caption .fadeInDown-2, " + owlElementID + " .caption .fadeInDown-3").css({ opacity: 0, top: "-15px" });
        }
    }

    function fadeInUpReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").stop().delay(800).animate({ opacity: 0, top: "15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInUp-1, " + owlElementID + " .caption .fadeInUp-2, " + owlElementID + " .caption .fadeInUp-3").css({ opacity: 0, top: "15px" });
        }
    }

    function fadeInLeftReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").stop().delay(800).animate({ opacity: 0, left: "15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInLeft-1, " + owlElementID + " .caption .fadeInLeft-2, " + owlElementID + " .caption .fadeInLeft-3").css({ opacity: 0, left: "15px" });
        }
    }

    function fadeInRightReset() {
        if (!dragging) {
            $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").stop().delay(800).animate({ opacity: 0, left: "-15px" }, { duration: 400, easing: "easeInCubic" });
        }
        else {
            $(owlElementID + " .caption .fadeInRight-1, " + owlElementID + " .caption .fadeInRight-2, " + owlElementID + " .caption .fadeInRight-3").css({ opacity: 0, left: "-15px" });
        }
    }

    function fadeIn() {
        $(owlElementID + " .active .caption .fadeIn-1").stop().delay(500).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeIn-2").stop().delay(700).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeIn-3").stop().delay(1000).animate({ opacity: 1 }, { duration: 800, easing: "easeOutCubic" });
    }

    function fadeInDown() {
        $(owlElementID + " .active .caption .fadeInDown-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInDown-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInDown-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
    }

    function fadeInUp() {
        $(owlElementID + " .active .caption .fadeInUp-1").stop().delay(500).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInUp-2").stop().delay(700).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInUp-3").stop().delay(1000).animate({ opacity: 1, top: "0" }, { duration: 800, easing: "easeOutCubic" });
    }

    function fadeInLeft() {
        $(owlElementID + " .active .caption .fadeInLeft-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInLeft-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInLeft-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
    }

    function fadeInRight() {
        $(owlElementID + " .active .caption .fadeInRight-1").stop().delay(500).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInRight-2").stop().delay(700).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
        $(owlElementID + " .active .caption .fadeInRight-3").stop().delay(1000).animate({ opacity: 1, left: "0" }, { duration: 800, easing: "easeOutCubic" });
    }

    $(owlElementID).owlCarousel({

        autoPlay: 3000,
        stopOnHover: true,
        autoplayHoverPause:true,
        navigation: true,
        pagination: true,
        singleItem: true,
        addClassActive: true,
        transitionStyle: "fade",
        navigationText: ["<i class='icon fa fa-angle-left'></i>", "<i class='icon fa fa-angle-right'></i>"],

        afterInit: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
        },

        afterMove: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
        },

        afterUpdate: function() {
            fadeIn();
            fadeInDown();
            fadeInUp();
            fadeInLeft();
            fadeInRight();
        },

        startDragging: function() {
            dragging = true;
        },

        afterAction: function() {
            fadeInReset();
            fadeInDownReset();
            fadeInUpReset();
            fadeInLeftReset();
            fadeInRightReset();
            dragging = false;
        }

    });

if ($(owlElementID).hasClass("owl-one-item")) {
    $(owlElementID + ".owl-one-item").data('owlCarousel').destroy();
}

$(owlElementID + ".owl-one-item").owlCarousel({
    singleItem: true,
    navigation: false,
    pagination: false
});

$('#transitionType li a').click(function () {

    $('#transitionType li a').removeClass('active');
    $(this).addClass('active');

    var newValue = $(this).attr('data-transition-type');

    $(owlElementID).data("owlCarousel").transitionTypes(newValue);
    $(owlElementID).trigger("owl.next");

    return false;

});


$('.home-owl-carousel').each(function(){

    var owl = $(this);
    var  itemPerLine = owl.data('item');
    if(!itemPerLine){
        itemPerLine = 4;
    }
    owl.owlCarousel({
        autoPlay: 2000,
        stopOnHover: true,
        autoplayHoverPause:true,
        items : itemPerLine,
        itemsTablet:[768,2],
        navigation : true,
        pagination : false,
      
        navigationText: ["", ""]
    });
});

$('.homepage-owl-carousel').each(function(){

    var owl = $(this);
    var  itemPerLine = owl.data('item');
    if(!itemPerLine){
        itemPerLine = 4;
    }
    owl.owlCarousel({
        stopOnHover: true,
        autoplayHoverPause:true,
        items : itemPerLine,
        itemsTablet:[768,2],
        itemsDesktop : [1199,2],
        navigation : true,
        pagination : false,

        navigationText: ["", ""]
    });
});

$(".blog-slider").owlCarousel({
    items : 2,
    itemsDesktopSmall :[979,2],
    itemsDesktop : [1199,2],
    navigation : true,
    slideSpeed : 300,
    pagination: false,
    navigationText: ["", ""]
});

$(".best-seller").owlCarousel({
    items : 3,
    navigation : true,
    itemsDesktopSmall :[979,2],
    itemsDesktop : [1199,2],
    slideSpeed : 300,
    pagination: false,
    paginationSpeed : 400,
    navigationText: ["", ""]
});

$(".sidebar-carousel").owlCarousel({
    items : 1,
    itemsTablet:[768,2],
    itemsDesktopSmall :[979,2],
    itemsDesktop : [1199,1],
    navigation : true,
    slideSpeed : 300,
    pagination: false,
    paginationSpeed : 400,
    navigationText: ["", ""]
});

$(".brand-slider").owlCarousel({
    items : 6,
    navigation : true,
    slideSpeed : 300,
    pagination: false,
    paginationSpeed : 400,
    navigationText: ["", ""]
});    
$("#advertisement").owlCarousel({
    items : 1,
    itemsDesktopSmall :[979,2],
    itemsDesktop : [1199,1],
    navigation : true,
    slideSpeed : 300,
    pagination: true,
    paginationSpeed : 400,
    navigationText: ["", ""]
});    

var $owl_controls_custom = $('.owl-controls-custom');
$('.owl-next' , $owl_controls_custom).click(function(event){
    var selector = $(this).data('owl-selector');
    var owl = $(selector).data('owlCarousel');
    owl.next();
    return false;
});
$('.owl-prev' , $owl_controls_custom).click(function(event){
    var selector = $(this).data('owl-selector');
    var owl = $(selector).data('owlCarousel');
    owl.prev();
    return false;
});

$(".owl-next").click(function(){
    $($(this).data('target')).trigger('owl.next');
    return false;
});

$(".owl-prev").click(function(){
    $($(this).data('target')).trigger('owl.prev');
    return false;
});

});

/*===================================================================================*/
/*  LAZY LOAD IMAGES USING ECHO
/*===================================================================================*/
// $(document).ready(function(){
//     echo.init({
//         offset: 100,
//         throttle: 250,
//         unload: true
//     });
// });
window.echo = (function (window, document) {

  'use strict';

  /*
   * Constructor function
   */
  var Echo = function (elem) {
    this.elem = elem;
    this.render();
    this.listen();
  };

  /*
   * Images for echoing
   */
  var echoStore = [];
  
  /*
   * Element in viewport logic
   */
  var scrolledIntoView = function (element) {
    var coords = element.getBoundingClientRect();
    return ((coords.top >= 0 && coords.left >= 0 && coords.top) <= (window.innerHeight || document.documentElement.clientHeight));
  };

  /*
   * Changing src attr logic
   */
  var echoSrc = function (img, callback) {
    img.src = img.getAttribute('data-echo');
    if (callback) {
      callback();
    }
  };

  /*
   * Remove loaded item from array
   */
  var removeEcho = function (element, index) {
    if (echoStore.indexOf(element) !== -1) {
      echoStore.splice(index, 1);
    }
  };

  /*
   * Echo the images and callbacks
   */
  var echoImages = function () {
    for (var i = 0; i < echoStore.length; i++) {
      var self = echoStore[i];
      if (scrolledIntoView(self)) {
        echoSrc(self, removeEcho(self, i));
      }
    }
  };

  /*
   * Prototypal setup
   */
  Echo.prototype = {
    init : function () {
      echoStore.push(this.elem);
    },
    render : function () {
      if (document.addEventListener) {
        document.addEventListener('DOMContentLoaded', echoImages, false);
      } else {
        window.onload = echoImages;
      }
    },
    listen : function () {
      window.onscroll = echoImages;
    }
  };

  /*
   * Initiate the plugin
   */
  var lazyImgs = document.querySelectorAll('img[data-echo]');
  for (var i = 0; i < lazyImgs.length; i++) {
    new Echo(lazyImgs[i]).init();
  }

})(window, document);
/*===================================================================================*/
/*  RATING
/*===================================================================================*/

$(document).ready(function(){
    $('.rating').rateit({max: 5, step: 1, value : 4, resetable : false , readonly : true});
});

/*===================================================================================*/
/* PRICE SLIDER
/*===================================================================================*/
$(document).ready(function () {

// Price Slider
if ($('.price-slider').length > 0) {
    $('.price-slider').slider({
        min: 100,
        max: 700,
        step: 10,
        value: [200, 500],
        handle: "square"

    });

}

});


/*===================================================================================*/
/* SINGLE PRODUCT GALLERY
/*===================================================================================*/
$(document).ready(function(){
    $('#owl-single-product').owlCarousel({
        items:1,
        itemsTablet:[768,2],
        itemsDesktop : [1199,1]

    });

    $('#owl-single-product-thumbnails').owlCarousel({
        items: 4,
        pagination: true,
        rewindNav: true,
        itemsTablet : [768, 4],
        itemsDesktop : [1199,3]
    });

    $('#owl-single-product2-thumbnails').owlCarousel({
        items: 6,
        pagination: true,
        rewindNav: true,
        itemsTablet : [768, 4],
        itemsDesktop : [1199,3]
    });

    $('.single-product-slider').owlCarousel({
        stopOnHover: true,
        rewindNav: true,
        singleItem: true,
        pagination: true
    });

    $(".slider-next").click(function () {
        var owl = $($(this).data('target'));
        owl.trigger('owl.next');
        return false;
    });

    $(".slider-prev").click(function () {
        var owl = $($(this).data('target'));
        owl.trigger('owl.prev');
        return false;
    });

    $('.single-product-gallery .horizontal-thumb').click(function(){
        var $this = $(this), owl = $($this.data('target')), slideTo = $this.data('slide');
        owl.trigger('owl.goTo', slideTo);
        $this.addClass('active').parent().siblings().find('.active').removeClass('active');
        return false;
    });
});


/*===================================================================================*/
/*  QUANTITY
/*===================================================================================*/

$('.quant-input .plus').click(function() {
    var val = $(this).parent().next().val();
    val = parseInt(val) + 1;
    $(this).parent().next().val(val);
});
$('.quant-input .kgPlus').click(function() {
    var val = $(this).parent().next().val();
    val = parseInt(val) + 1;
    $(this).parent().next().val(val);
});
$('.quant-input .gmPlus').click(function() {
    var val = $(this).parent().next().val();
    if(val < 950){
        val = parseInt(val) + 50;
    }
    else{
        $('.quant-input .kgPlus').parent().next().val(parseInt($('.quant-input .kgPlus').parent().next().val())+1);
        val = 0;
    }
    $(this).parent().next().val(val);
});
$('.quant-input .kgMinus').click(function() {
    var val = $(this).parent().next().val();
    if (val > 0) {
        val = parseInt(val) - 1;
        $(this).parent().next().val(val);
    }
});
$('.quant-input .gmMinus').click(function() {
    var val = $(this).parent().next().val();
    if (val > 0) {

        val = parseInt(val) - 50;
        
    }else{
        var kgVal = $('.quant-input .kgMinus').parent().next().val();
        if(kgVal > 0){
            val = 950;
            $('.quant-input .kgMinus').parent().next().val(parseInt(kgVal)-1);
        }
    }
    $(this).parent().next().val(val);
});

$('.quant-input .minus').click(function() {
    var val = $(this).parent().next().val();
    if (val > 0) {
        val = parseInt(val) - 1;
        $(this).parent().next().val(val);
    }
});



/*===================================================================================*/
/*  WOW 
/*===================================================================================*/

$(document).ready(function () {
    new WOW().init();
});


/*===================================================================================*/
/*  TOOLTIP 
/*===================================================================================*/
$("[data-toggle='tooltip']").tooltip(); 

$('#transitionType li a').click(function () {

    $('#transitionType li a').removeClass('active');
    $(this).addClass('active');

    var newValue = $(this).attr('data-transition-type');

    $(owlElementID).data("owlCarousel").transitionTypes(newValue);
    $(owlElementID).trigger("owl.next");

    return false;

});


})(jQuery);
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}