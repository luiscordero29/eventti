<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (is_user_logged_in()){

global $product; global $current_user;

?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

	<p class="price"><?php echo $product->get_price_html(); ?></p>

	<meta itemprop="price" content="<?php echo esc_attr( $product->get_display_price() ); ?>" />
	<meta itemprop="priceCurrency" content="<?php echo esc_attr( get_woocommerce_currency() ); ?>" />
	<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

</div>
<div class="sugerencia">
	<?php
		# cantidad recomendad para 100 invitados
		$sugerencia = get_post_meta( $product->id, 'sugerencia', true );
		# cantidad de invitados que registre
		$eventti_invitados = get_user_meta($current_user->ID, 'eventti_invitados', true);
		# cantidad sugeridad
		$total =  intval($eventti_invitados*$sugerencia/100);
		# show
		echo "<b>La cantidad sugerida para ".$eventti_invitados." invitados es de ".$total." unidades</b>";
	?>
</div>
<?php } ?>
