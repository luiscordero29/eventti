<?php
function eventti_woocommerce_categorias_controller() {

    $view =
    '<div id="woocommerce_categorias">
        <div class="row">';

    $args = array(
        'hide_empty' => 0,
        'orderby'    => 'title',
        'order'      => 'ASC',
    );
    $product_categories = get_terms( 'product_cat', $args );
    $item = 0;
    foreach ( $product_categories as $product_category ){
        $item++;
        if ($item<>1) {
            $class = '';
        }else{
            $class = 'col-xs-offset-1';
        }
        $image_id = get_woocommerce_term_meta( $product_category->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $image_id );
        $image_hover_id = get_option( "product_cat_".$product_category->term_id."_category_image_hover" );
        $image_hover = wp_get_attachment_url( $image_hover_id );
        if (!strlen($image)>0) {
          $image = get_template_directory_uri().'/assets/images/not-image.jpg';
        }
        if (!strlen($image_hover)>0) {
          $image_hover = get_template_directory_uri().'/assets/images/not-image.jpg';
        }
        if (is_user_logged_in()){
          $view .= '<div class="col-xs-2 '.$class.'"><a href="' . get_term_link( $product_category ) . '"><div class="categoria_producto categoria_producto_'.$product_category->term_id.'">';
          $view .= '<div class="categoria_nombre">'.$product_category->name.'</div>';
          $view .= '<div class="categoria_imagen categoria_imagen_'.$product_category->term_id.'"><img src="' . $image . '" alt="" /></div>';
          $view .= '<div class="categoria_imagen_hover categoria_imagen_hover_'.$product_category->term_id.'"><img src="' . $image_hover . '" alt="" /></div>';
          $view .= '</div></a></div>';
        }else{
          if ($_SESSION['visitas']<3) {
            $view .= '<div class="col-xs-2 '.$class.'"><a href="' . get_term_link( $product_category ) . '"><div class="categoria_producto categoria_producto_'.$product_category->term_id.'">';
            $view .= '<div class="categoria_nombre">'.$product_category->name.'</div>';
            $view .= '<div class="categoria_imagen categoria_imagen_'.$product_category->term_id.'"><img src="' . $image . '" alt="" /></div>';
            $view .= '<div class="categoria_imagen_hover categoria_imagen_hover_'.$product_category->term_id.'"><img src="' . $image_hover . '" alt="" /></div>';
            $view .= '</div></a></div>';
          }else{
            $view .= '<div class="col-xs-2 '.$class.'"><a data-toggle="modal" data-target="#ModalLogIn" href="#ModalLogIn"><div class="categoria_producto categoria_producto_'.$product_category->term_id.'">';
            $view .= '<div class="categoria_nombre">'.$product_category->name.'</div>';
            $view .= '<div class="categoria_imagen categoria_imagen_'.$product_category->term_id.'"><img src="' . $image . '" alt="" /></div>';
            $view .= '<div class="categoria_imagen_hover categoria_imagen_hover_'.$product_category->term_id.'"><img src="' . $image_hover . '" alt="" /></div>';
            $view .= '</div></a></div>';
          }
        }

        if ($item>=5) {
            $item = 0;
            $view .= '</div><div class="row">';
        }

        # javascript
        wc_enqueue_js( "

          jQuery(document).ready(function(){
              $( '.categoria_producto_".$product_category->term_id." .categoria_imagen_".$product_category->term_id."' ).hide();
              $( '.categoria_producto_".$product_category->term_id." .categoria_imagen_hover_".$product_category->term_id."' ).show();

              $( '.categoria_producto_".$product_category->term_id."' )
                  .mouseout(function() {
                    $( '.categoria_producto_".$product_category->term_id." .categoria_imagen_".$product_category->term_id."' ).hide();
                    $( '.categoria_producto_".$product_category->term_id." .categoria_imagen_hover_".$product_category->term_id."' ).show();
                  })
                  .mouseover(function() {
                    $( '.categoria_producto_".$product_category->term_id." .categoria_imagen_".$product_category->term_id."' ).show();
                    $( '.categoria_producto_".$product_category->term_id." .categoria_imagen_hover_".$product_category->term_id."' ).hide();
                  });
          });

        " );
    }

    $view .= '</div></div>';

    return $view;

}

add_shortcode( 'eventti_woocommerce_categorias', 'eventti_woocommerce_categorias_controller' );
?>
