<?php
/*
    SESSION
*/
session_start();
if (empty($_SESSION['visitas'])) {
    $_SESSION['visitas'] = 0;
}
if (empty($_SESSION['cat_1'])) {
    $_SESSION['cat_1'] = 0;
}
if (empty($_SESSION['cat_2'])) {
    $_SESSION['cat_2'] = 0;
}
if (empty($_SESSION['cat_3'])) {
    $_SESSION['cat_3'] = 0;
}
/*
    MENUS
*/
add_image_size( 'thumbnail_product', 200, 200, array( 'left', 'top' ) );

/*
    MENUS
*/
function register_menus() {
  register_nav_menus(
    array(

        # HEADER
        'main'                  => __( 'MENU PRINCIPAL' ),
        'social'                => __( 'REDES SOCIALES' ),
        'login'                 => __( 'LOGIN' ),
        'mobile'                => __( 'MOBILE' ),

    )
  );
}

add_action( 'init', 'register_menus' );

/*
 Post Type: TESTIMONIOS
*/
add_action( 'init', 'testimonios' );

function testimonios() {

  $labels = array(
    'name'                => _x( 'TESTIMONIOS', 'Lista de Publicaciones' ),
    'singular_name'       => _x( 'Publicación', 'Información del Publicación' ),
    'add_new'             => _x( 'Añadir nuevo', 'Publicación' ),
    'add_new_item'        => __( 'Añadir nuevo Publicación' ),
    'edit_item'           => __( 'Editar Publicación' ),
    'new_item'            => __( 'Nuevo Publicación' ),
    'view_item'           => __( 'Ver Publicación' ),
    'search_items'        => __( 'Buscar Publicación' ),
    'not_found'           => __( 'No se han encontrado Publicación' ),
    'not_found_in_trash'  => __( 'No se han encontrado Publicación en la papelera' ),
    'parent_item_colon'   => ''
  );

  // Creamos un array para $args
  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'query_var'           => true,
    'rewrite'             => array('slug' => 'testimonios'),
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'menu_position'       => null,
    'supports'            => array( 'title', 'editor' )
  );

  register_post_type( 'testimonios', $args );
}

/*
 Post Type: GALERIA
*/
add_action( 'init', 'galeria' );

function galeria() {

  $labels = array(
    'name'                => _x( 'GALERIA', 'Lista de Publicaciones' ),
    'singular_name'       => _x( 'Publicación', 'Información del Publicación' ),
    'add_new'             => _x( 'Añadir nuevo', 'Publicación' ),
    'add_new_item'        => __( 'Añadir nuevo Publicación' ),
    'edit_item'           => __( 'Editar Publicación' ),
    'new_item'            => __( 'Nuevo Publicación' ),
    'view_item'           => __( 'Ver Publicación' ),
    'search_items'        => __( 'Buscar Publicación' ),
    'not_found'           => __( 'No se han encontrado Publicación' ),
    'not_found_in_trash'  => __( 'No se han encontrado Publicación en la papelera' ),
    'parent_item_colon'   => ''
  );

  // Creamos un array para $args
  $args = array(
    'labels'              => $labels,
    'public'              => true,
    'publicly_queryable'  => true,
    'show_ui'             => true,
    'query_var'           => true,
    'rewrite'             => array('slug' => 'galeria'),
    'capability_type'     => 'post',
    'hierarchical'        => false,
    'menu_position'       => null,
    'supports'            => array( 'title' )
  );

  register_post_type( 'galeria', $args );
}

/*
  Listados de Widgets
*/

function syi_widgets_init() {

    # FOOTER
    register_sidebar(
        array(
            'name'          => 'FOOTER_1: MENU',
            'id'            => 'footer_1',
            'before_widget' => '<div class="menu">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<div class="title">',
            'after_title'   => '</div><div class="content">',
        )
    );

    register_sidebar(
        array(
            'name'          => 'FOOTER_2: MENU',
            'id'            => 'footer_2',
            'before_widget' => '<div class="menu">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<div class="title">',
            'after_title'   => '</div><div class="content">',
        )
    );

    register_sidebar(
        array(
            'name'          => 'FOOTER_3: MENU',
            'id'            => 'footer_3',
            'before_widget' => '<div class="menu">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<div class="title">',
            'after_title'   => '</div><div class="content">',
        )
    );

    register_sidebar(
        array(
            'name'          => 'FOOTER_4: MENU',
            'id'            => 'footer_4',
            'before_widget' => '<div class="menu">',
            'after_widget'  => '</div></div>',
            'before_title'  => '<div class="title">',
            'after_title'   => '</div><div class="content">',
        )
    );

}
add_action( 'widgets_init', 'syi_widgets_init' );

/*
  Carro / Productos
*/
function car_product(){

  $car = $nproduct = 0;
  if ( ! WC()->cart->is_empty() ) {
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			    $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			    $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
          if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				      $car++;
				  }
			}
	}
  $args = array(
    'post_type' 		=> 'product',
    'posts_per_page' 	=> -1,
  );
  $query = new WP_Query( $args );
  if ( $query->have_posts() ){
    while ( $query->have_posts() ) : $query->the_post();
      global $post; global $product; global $woocommerce;
      $nproduct++;
    endwhile;
  }
  wp_reset_postdata();

  return $car . '/' . $nproduct;

}


function wooc_extra_register_fields() {

    ?>

        <p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
    				<label for="eventti_invitados">Cuantos Invidatos Son?<span class="required">*</span></label>
    				<input type="text" class="form-control" name="eventti_invitados" id="eventti_invitados" value="<?php if ( ! empty( $_POST['eventti_invitados'] ) ) echo esc_attr( $_POST['eventti_invitados'] ); ?>" />
    		</p>

    <?php

}

add_action( 'woocommerce_register_form_end', 'wooc_extra_register_fields' );


function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {

      if ( isset( $_POST['eventti_invitados'] ) && empty( $_POST['eventti_invitados'] ) ) {

            $validation_errors->add( 'eventti_invitados_name_error', __( ' Cuantos Invidatos Son?', 'woocommerce' ) );

      }

      $eventti_invitados = intval($_POST['eventti_invitados']);
      if ( $eventti_invitados <= 0 ) {

            $validation_errors->add( 'eventti_invitados_name_error', __( ' Debe Ingresar una cantidad Mayor a 0.', 'woocommerce' ) );

      }


}

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

function wooc_save_extra_register_fields( $customer_id )
{

    if ( isset( $_POST['eventti_invitados'] ) ) {
  		update_user_meta( $customer_id, 'eventti_invitados', sanitize_text_field( intval($_POST['eventti_invitados']) ) );
  	}

}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );


function eventti_profile_fields( $user ) {

    $eventti_invitados = get_user_meta($user->ID, 'eventti_invitados', true);

    ?>
    <h3>Eventti</h3>
    <table class="form-table">
   	 <tr>
   		 <th><label for="eventti_invitados">Cuantos Invidatos Son?</label></th>
   		 <td>
   			 <input type="text" name="eventti_invitados" id="eventti_invitados" value="<?php echo $eventti_invitados; ?>" class="regular-text code">
   		 </td>
   	 </tr>
    </table>
    <?php
}

add_action( 'show_user_profile', 'eventti_profile_fields' );
add_action( 'edit_user_profile', 'eventti_profile_fields' );

function eventti_save_profile_fields( $user_id )
{
    $eventti_invitados = intval($_POST['eventti_invitados']);
    if ( ($eventti_invitados > 0) and (isset( $_POST['eventti_invitados'] )) ) {

        update_user_meta( $user_id, 'eventti_invitados', sanitize_text_field( $eventti_invitados ) );

    }
}

add_action( 'personal_options_update', 'eventti_save_profile_fields' );
add_action( 'edit_user_profile_update', 'eventti_save_profile_fields' );

/*
  Shortcodes
*/
include(TEMPLATEPATH.'/shortcodes/woocommerce_categorias.php');
