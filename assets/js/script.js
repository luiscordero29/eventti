$(document).ready(function() {

    $("#owl-seccion_3").owlCarousel({
        navigation : false, // Show next and prev buttons
        slideSpeed : 500,
        paginationSpeed : 400,
        singleItem: true,
        autoPlay: true,
        stopOnHover: true,
    });

    $("#owl-seccion_6").owlCarousel({
        navigation : false, // Show next and prev buttons
        slideSpeed : 500,
        paginationSpeed : 400,
        singleItem: true,
        autoPlay: true,
        stopOnHover: true,
    });

    /* Menu Mobile */
    $( "#mobile_open" ).click(function() {
      $( ".mobile-menu" ).animate({
        right: "0px"
      }, 200 );
    });
    $( "#mobile_close" ).click(function() {
      $( ".mobile-menu" ).animate({
        right: "-200px"
      }, 200 );
    });

    /* Login Form */
    $( "a#woocommerce_register" ).click(function() {
      $( "form#form_woocommerce_register" ).show();
      $( "form#form_woocommerce_login" ).hide();
    });
    $( "a.ModalRegister" ).click(function() {
      $( "form#form_woocommerce_register" ).show();
      $( "form#form_woocommerce_login" ).hide();
    });
    $( "a#woocommerce_login" ).click(function() {
      $( "form#form_woocommerce_login" ).show();
      $( "form#form_woocommerce_register" ).hide();
    });
    $( "a.ModalLogIn" ).click(function() {
      $( "form#form_woocommerce_login" ).show();
      $( "form#form_woocommerce_register" ).hide();
    });

});
