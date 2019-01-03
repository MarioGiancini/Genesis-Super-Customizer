jQuery(function( $ ){

  $(window).scroll(function () {
    if ($(document).scrollTop() > 60 ) {

      $('.site-header').addClass('shrink');


    } else {


      $('.site-header').removeClass('shrink');

    }
  });

});
