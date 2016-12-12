<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

?>
<div id="woocommerce">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
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
			</div>
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



<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">

		<?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

	</div><!-- .summary -->

	<?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
