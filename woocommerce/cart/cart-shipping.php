<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
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
 * @version     2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="cart__block-subheader">
	<?php echo esc_attr( $package_name ); ?>
</div>

<?php if ( 1 < count( $available_methods ) ) : ?>
	<ul class="cart__shipping-method" id="shipping_method">
		<?php foreach ( $available_methods as $method ) : ?>
			<li class="cart__block-row">
				<?php
					printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method cart__block-radio" data-cost="%6$s" %4$s />
						<label class="cart__block-label cart__block-label--radio" for="shipping_method_%1$d_%2$s">%5$s</label>%7$s',
						$index, sanitize_title( $method->id ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ), $method->label, $method->cost, '<div class="cart__block-sign">' . number_format($method->cost, 0, ',', '') . ' руб.</div>' );

					do_action( 'woocommerce_after_shipping_rate', $method, $index );
				?>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>