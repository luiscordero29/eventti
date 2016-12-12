<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
        <!-- Bootstrap -->
        <link href="<?php echo get_template_directory_uri(); ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo get_template_directory_uri(); ?>/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Style -->
        <link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">
        <!-- Important Owl stylesheet -->
        <link href="<?php echo get_template_directory_uri(); ?>/assets/owl-carousel/owl.carousel.css" rel="stylesheet">
        <!-- Default Theme -->
        <link href="<?php echo get_template_directory_uri(); ?>/assets/owl-carousel/owl.theme.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php if (is_admin()): ?>
          <style media="screen">
            .mobile .mobile-menu {
              top: 30px;
            }
          </style>
        <?php endif; ?>
    </head>
    <body>
    <div class="mobile">

      <div class="mobile-menu">
        <a id="mobile_close" class="mobile_close" href="#mobile"><i class="fa fa-times" aria-hidden="true"></i></a>
        <div class="widget_car">
            <div class="widget_car_title">
              SHOPPING CART
            </div>
            <div class="widget_car_content">
              <?php if ( ! WC()->cart->is_empty() ) : ?>

                <?php
                  foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                      $product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                      $thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                      $product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
                      $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                      ?>
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="cart-item">
                            <?php echo $product_name;	?>
                            <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
                          </div>
                        </div>
                      </div>
                      <?php
                    }
                  }
                ?>

              <?php else : ?>
                <div class="row">
                  <div class="col-xs-12">
                    <div class="cart-no-products">
                      <?php _e( 'No products in the cart.', 'woocommerce' ); ?>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

            <?php if ( ! WC()->cart->is_empty() ) : ?>

              <p class="total"><strong><?php _e( 'Subtotal', 'woocommerce' ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

              <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

              <div class="menu-mobile">
                <?php
                    unset($menu_list);
                    $menu_name = 'mobile';
                    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) )
                    {
                        $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );
                        $menu_items = wp_get_nav_menu_items($menu->term_id);
                        $menu_list = '<ul class="nav nav-pills nav-stacked">';
                        foreach ( (array) $menu_items as $key => $menu_item )
                        {
                            $menu_list .= '<li>';
                            $menu_list .= '<a href="' . $menu_item->url . '" target="' . $menu_item->target . '">';
                            $menu_list .= $menu_item->title;
                            $menu_list .= '</a>';
                            $menu_list .= '</li>';
                        }
                        $menu_list .= '</ul>';
                    }
                    echo $menu_list;
                ?>
              </div>

            <?php endif; ?>
            </div>
        </div>
      </div>
