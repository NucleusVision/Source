new WOW().init();

jQuery(document).ready(function($) {
    $('.na-counter').counterUp({
        delay: 10,
        time: 1000
    });
});

$(document).ready(function(){

  /*Menu*/
  var $menu = $("#menu").mmenu({
    "offCanvas": {
      "position": "right"
    }
  });

  var $icon = $("#nav-icon1");
  var API = $menu.data( "mmenu" );

  $icon.on( "click", function() {
     API.open();
  });

  API.bind( "open:finish", function() {
     setTimeout(function() {
        $icon.addClass( "open" );
     }, 100);
  });
  API.bind( "close:finish", function() {
     setTimeout(function() {
        $icon.removeClass( "open" );
     }, 100);
  });

	$('#nav-icon1').click(function(){
 		$(this).toggleClass('open');
    	$(".m-menu-bg").toggleClass("open");
  	});

  	$("#gotop").hide();
    $(window).scroll(function () {
        if ($(this).scrollTop() > 80) {
            $('#gotop').fadeIn();
        } else {
            $('#gotop').fadeOut();
        }
    });

    $('#gotop').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });


    $(".header").css("height", $(window).height());

    function alignModal(){
      var modalDialog = $(this).find(".modal-dialog");
      modalDialog.css("margin-top", Math.max(0, ($(window).height() - modalDialog.height()) / 2));
    }
    $(".modal").on("shown.bs.modal", alignModal);
    $(window).on("resize", function(){
        $(".modal:visible").each(alignModal);
    }); 

    $('.patent-carousel').owlCarousel({
      loop:true,
      /*autoplay:true,
      autoplayTimeout:5000,
      autoplayHoverPause:true,*/
      margin:10,
      dots:true,
      nav:false,
      responsiveClass:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:2
          },
          1000:{
              items:2
          }
      }
    });

});

$(window).resize(function(){
    $(".header").css("height", $(window).height());
});

$(window).on("load", function (e) {
	$(".spinner").delay(300).fadeOut();
	$(".loader").delay(600).fadeOut("slow");
  $("#menu").css({
    "opacity":"1",
    "height": "auto"
  });

});

