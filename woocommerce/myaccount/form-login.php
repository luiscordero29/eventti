<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<form method="post" class="login" id="form_woocommerce_login" action="/mi-cuenta/#woocommerce_login">

		<?php do_action( 'woocommerce_login_form_start' ); ?>

		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="form-control" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
		</p>

		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input class="form-control" type="password" name="password" id="password" />
		</p>

		<?php do_action( 'woocommerce_login_form' ); ?>

		<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<label for="rememberme" class="inline">
					<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'woocommerce' ); ?>
				</label>
		</p>

		<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a>
		</p>

		<div class="row">
			<div class="col-xs-6">
				<div class="btn-login">
					<input type="submit" class="btn btn-defaul" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>" />
				</div>
			</div>
			<div class="col-xs-6">
				<div class="btn-register">
					<a id="woocommerce_register" href="#woocommerce_register" class="btn btn-default"><?php esc_attr_e( 'Register', 'woocommerce' ); ?></a>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>

<form method="post" class="register" id="form_woocommerce_register" action="/mi-cuenta/#woocommerce_register">

		<?php do_action( 'woocommerce_register_form_start' ); ?>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="text" class="form-control" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" />
		</p>

		<?php endif; ?>

		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="email" class="form-control" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" />
		</p>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

		<p class="woocommerce-FormRow woocommerce-FormRow--wide form-row form-row-wide">
				<label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<input type="password" class="form-control" name="password" id="reg_password" />
		</p>

		<?php endif; ?>

		<!-- Spam Trap -->
		<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" autocomplete="off" /></div>

		<?php do_action( 'woocommerce_register_form' ); ?>
		<?php do_action( 'register_form' ); ?>
		<?php do_action( 'woocommerce_register_form_end' ); ?>

		<div class="row">
			<div class="col-xs-6">
				<div class="btn-register">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<input type="submit" class="btn btn-defaul" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" />
				</div>
			</div>
			<div class="col-xs-6">
				<div class="btn-login">
					<a id="woocommerce_login" href="#woocommerce_login" class="btn btn-default"><?php esc_attr_e( 'Login', 'woocommerce' ); ?></a>
				</div>
			</div>
		</div>



</form>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
