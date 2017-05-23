<?php
/**
 * Review order table
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/review-order.php.
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
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php
do_action( 'woocommerce_review_order_before_cart_contents' );

foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
	$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

	if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
		$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
		?>
		<div class="cart__block-row cart__block-row--product">
			<div class="cart__block-product_image">
				<?php echo $thumbnail; ?>
			</div>
			<div class="cart__block-product_title"><?php echo $_product->name; ?></div>
			<div class="cart__block-product_buttons">
				<button class="cart__block-product_btn cart__block-product_btn--plus" data-product_id="<?php echo $cart_item_key; ?>"></button>
				<input type="text" class="cart__block-product_input" placeholder="1" id="product-count" value="<?php echo $cart_item['quantity']; ?>">
				<button class="cart__block-product_btn cart__block-product_btn--minus" data-product_id="<?php echo $cart_item_key; ?>"></button>
				<?php
				echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
					'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
					esc_url(WC()->cart->get_remove_url($cart_item_key)),
					__('Remove this item', 'woocommerce'),
					esc_attr($product_id),
					esc_attr($_product->get_sku())
				), $cart_item_key);
				?>
			</div>
			<div class="cart__block-product_sum"><?php echo $_product->price; ?> руб.</div>
		</div>
		<?php
	}
}
$packages = WC()->shipping->get_packages();
foreach ( $packages as $i => $package ) {
	$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
}
$shipping_name = $package['rates']["$chosen_method"]->label;
$shipping_cost = $package['rates']["$chosen_method"]->cost;
?>

<div class="cart__block-product_block">
	<div class="cart__block-row">
		<div class="cart__block-product_title"><?php _e('Subtotal', 'woocommerce'); ?></div>
		<div class="cart__block-product_sum" id="product-subtotal" data-subtotal="<?php echo WC()->cart->subtotal; ?>"><?php echo number_format(WC()->cart->subtotal, 0, ',', ' '); ?>
			руб.
		</div>
	</div>
	<div class="cart__block-row">
		<div class="cart__block-product_title" id="shipping-name"><?php echo $shipping_name; ?></div>
		<div class="cart__block-product_sum" id="shipping-cost"><?php echo number_format($shipping_cost, 0, ',', ''); ?> руб.</div>
	</div>
	<div class="cart__block-row cart__block-row--amount">
		<div class="cart__block-product_title">Итого</div>
		<div class="cart__block-product_sum" id="order-total_sum"><?php echo number_format(WC()->cart->total, 0, ',', ' '); ?> руб.</div>
	</div>
</div>

<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

	<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

	<?php wc_cart_totals_shipping_html(); ?>

	<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

<?php endif; ?>
