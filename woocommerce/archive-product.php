<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

# Login
if (!is_user_logged_in()){
	if ($_SESSION['visitas']>3) {
		if ( wp_get_referer() ){
		    wp_safe_redirect( wp_get_referer() );
		}else{
		    wp_safe_redirect( get_home_url() );
		}
	}
}

global $wp_query;
$category = $wp_query->get_queried_object();

$args = array(
	// Arguments for your query.
	'post_type' => 'product',
	'posts_per_page' => 1,
	'tax_query' => array(
		'relation' => 'AND',
			array(
				'taxonomy' => 'product_cat',
				'terms' => $category->term_id,
			)
		),
);
$query = new WP_Query( $args );
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) : $query->the_post();
		# Show Pictura
		if ( $query->has_post_thumbnail() ){
				echo $query->the_post_thumbnail( 'full' );
		}else{
				echo '<img src="'.get_template_directory_uri().'/assets/images/not-image.jpg" >';
		}
		global $product;

		$location = get_permalink( $product->id ) ;

	endwhile;
	wp_safe_redirect($location);
}else{
	if ( wp_get_referer() ){
	    wp_safe_redirect( wp_get_referer() );
	}else{
	    wp_safe_redirect( get_home_url() );
	}
}

///header("Location: ".$location);
///die();
/*
include(TEMPLATEPATH.'/includes/head.php');
include(TEMPLATEPATH.'/includes/header_woocommerce.php');
	# Verficar que exiten productos.
	if ( have_posts() ) :
		# Video de la categoria
			global $wp_query;
			$category = $wp_query->get_queried_object();
			$video = get_option( "product_cat_".$category->term_id."_category_link_video");
		?>
		<div id="woocommerce">
			<div class="container-fluid">
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1">
						<?php echo do_shortcode( '[embedyt]' . $video . '[/embedyt]' );?>
					</div>
					<div class="col-xs-5 col-xs-offset-1">
						<div class="row">
							<div class="col-xs-12">
								<div class="image-full">
								<?php
									$args = array(
										// Arguments for your query.
										'post_type' => 'product',
										'posts_per_page' => 1,
										'tax_query' => array(
											'relation' => 'AND',
												array(
													'taxonomy' => 'product_cat',
													'terms' => $category->term_id,
												)
											),
									);
									$query = new WP_Query( $args );
									while ( $query->have_posts() ) : $query->the_post();

										# Show Pictura
										if ( $query->has_post_thumbnail() ){
												echo $query->the_post_thumbnail( 'full' );
										}else{
												echo '<img src="'.get_template_directory_uri().'/assets/images/not-image.jpg" >';
										}
										global $product;

										$location = get_permalink( $product->id ) ;
										//wp_safe_redirect($location);
										header("Location: ".$location);
										die();

									endwhile;
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
																'terms' => $category->term_id,
															)
														),
												);
												$query = new WP_Query( $args );
												while ( $query->have_posts() ) : $query->the_post();
													echo '<div class="col-xs-3">';
													if ( has_post_thumbnail() ){
															echo the_post_thumbnail( 'full' );
													}else{
															echo '<img src="'.get_template_directory_uri().'/assets/images/not-image.jpg" >';
													}
													echo '</div>';
												endwhile;
											?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-5">
						<div class="content">
						<?php
							$args = array(
								// Arguments for your query.
								'post_type' => 'product',
								'posts_per_page' => 1,
								'tax_query' => array(
									'relation' => 'AND',
										array(
											'taxonomy' => 'product_cat',
											'terms' => $category->term_id,
										)
									),
							);
							$query = new WP_Query( $args );
							while ( $query->have_posts() ) : $query->the_post();
								global $post; global $product;
								echo the_title();
								echo the_content();
								echo $product->get_price_html();

								$parent_product_post = $post;

								do_action( 'woocommerce_before_add_to_cart_form' ); ?>

								<form class="cart" method="post" enctype='multipart/form-data'>
									<table cellspacing="0" class="group_table">
										<tbody>
											<?php
												foreach ( $grouped_products as $product_id ) :
													if ( ! $product = wc_get_product( $product_id ) ) {
														continue;
													}

													if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $product->is_in_stock() ) {
														continue;
													}

													$post    = $product->post;
													setup_postdata( $post );
													?>
													<tr>
														<td>
															<?php if ( $product->is_sold_individually() || ! $product->is_purchasable() ) : ?>
																<?php woocommerce_template_loop_add_to_cart(); ?>
															<?php else : ?>
																<?php
																	$quantites_required = true;
																	woocommerce_quantity_input( array(
																		'input_name'  => 'quantity[' . $product_id . ']',
																		'input_value' => ( isset( $_POST['quantity'][$product_id] ) ? wc_stock_amount( $_POST['quantity'][$product_id] ) : 0 ),
																		'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
																		'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
																	) );
																?>
															<?php endif; ?>
														</td>

														<td class="label">
															<label for="product-<?php echo $product_id; ?>">
																<?php echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $product_id ) ) . '">' . get_the_title() . '</a>' : get_the_title(); ?>
															</label>
														</td>

														<?php do_action ( 'woocommerce_grouped_product_list_before_price', $product ); ?>

														<td class="price">
															<?php
																echo $product->get_price_html();

																if ( $availability = $product->get_availability() ) {
																	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
																	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
																}
															?>
														</td>
													</tr>
													<?php
												endforeach;

												// Reset to parent grouped product
												$post    = $parent_product_post;
												$product = wc_get_product( $parent_product_post->ID );
												setup_postdata( $parent_product_post );
											?>
										</tbody>
									</table>

									<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

									<?php if ( $quantites_required ) : ?>

										<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

										<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

										<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

									<?php endif; ?>
								</form>

								<?php do_action( 'woocommerce_after_add_to_cart_form' );

							endwhile;
						?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	else:
		wc_get_template( 'loop/no-products-found.php' );
	endif;

include(TEMPLATEPATH.'/includes/footer.php'); */
?>
