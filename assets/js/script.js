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
    $( "#woocommerce_register" ).click(function() {
      $( "#form_woocommerce_register" ).show();
      $( "#form_woocommerce_login" ).hide();
    });
    $( ".ModalRegister" ).click(function() {
      $( "#form_woocommerce_register" ).show();
      $( "#form_woocommerce_login" ).hide();
    });
    $( "#woocommerce_login" ).click(function() {
      $( "#form_woocommerce_login" ).show();
      $( "#form_woocommerce_register" ).hide();
    });
    $( ".ModalLogIn" ).click(function() {
      $( "#form_woocommerce_login" ).show();
      $( "#form_woocommerce_register" ).hide();
    });

});
