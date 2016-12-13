<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

# Login
if (!is_user_logged_in()){
	$_SESSION['visitas'] = $_SESSION['visitas']+1;
	if ($_SESSION['visitas']>3) {
		if ( wp_get_referer() ){
		    wp_safe_redirect( wp_get_referer() );
		}else{
		    wp_safe_redirect( get_home_url() );
		}
	}
}

include(TEMPLATEPATH.'/includes/head.php');
include(TEMPLATEPATH.'/includes/header_woocommerce.php');

while ( have_posts() ) : the_post();
	global $wp_query, $product, $post;
	//echo var_dump($wp_query,$product,$post);
 	//wc_get_template_part( 'content', 'single-product' );
	$terms = get_the_terms( $post->ID, 'product_cat' );
	foreach ($terms as $term) {
	    $category_term_id 	= $term->term_id;
			$category_name 			= $term->name;
			$category_slug 			= $term->slug;
	    break;
	}
	$video = get_option( "product_cat_".$category_term_id."_category_link_video");
	?>
	<div id="woocommerce">
		<div class="container-fluid">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<?php
						/**
						 * woocommerce_before_single_product hook.
						 *
						 * @hooked wc_print_notices - 10
						 */
						 do_action( 'woocommerce_before_single_product' );

						 if ( post_password_required() ) {
						 	echo get_the_password_form();
						 	return;
						 }
					?>
					<?php echo do_shortcode( '[embedyt]' . $video . '[/embedyt]' );?>
				</div>
				<div class="col-xs-5 col-xs-offset-1">
					<div class="row">
						<div class="col-xs-12">
							<div class="image-full">
							<?php
									# Show Pictura
									if ( has_post_thumbnail() ){
											echo the_post_thumbnail( 'full' );
									}else{
											echo '<img src="'.get_template_directory_uri().'/assets/images/not-image.jpg" >';
									}
							?>
							</div>
						</div>
						<div class="col-xs-12">
							<div class="images-carousel">
								<div class="row">
										<?php
											$args = array(
												// Arguments for your query.
												'post_type' => 'product',
												'posts_per_page' => 4,
												'tax_query' => array(
													'relation' => 'AND',
														array(
															'taxonomy' => 'product_cat',
															'terms' => $category_term_id,
														)
													),
											);
											$query = new WP_Query( $args );
											while ( $query->have_posts() ) : $query->the_post();
												echo '<div class="col-xs-3"><div class="image-carousel"><a href="' . esc_url( get_permalink( $product->id ) ) .'" title="' . esc_attr( $product->get_title() ) . '"><div class="hover"></div>';
												if ( has_post_thumbnail() ){
														echo the_post_thumbnail( 'thumbnail_product' );
												}else{
														echo '<img src="'.get_template_directory_uri().'/assets/images/not-image.jpg" >';
												}
												echo '</a></div></div>';
											endwhile;
											wp_reset_postdata();
										?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-5">
					<div class="content">
					<?php do_action( 'woocommerce_single_product_summary' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
endwhile;

include(TEMPLATEPATH.'/includes/footer.php');
?>
