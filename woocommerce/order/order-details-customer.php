<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="woocommerce-customer-details">

	<h2><?php _e( 'Customer details', 'woocommerce' ); ?></h2>

	<table class="woocommerce-table woocommerce-table--customer-details shop_table customer_details">

		<tr>
			<th>ФИО клиента:</th>
			<td><?php echo $order->data['billing']['first_name']; ?></td>
		</tr>

		<?php if ( $order->get_customer_note() ) : ?>
			<tr>
				<th><?php _e( 'Note:', 'woocommerce' ); ?></th>
				<td><?php echo wptexturize( $order->get_customer_note() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->get_billing_email() ) : ?>
			<tr>
				<th><?php _e( 'Email:', 'woocommerce' ); ?></th>
				<td><?php echo esc_html( $order->get_billing_email() ); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ( $order->get_billing_phone() ) : ?>
			<tr>
				<th><?php _e( 'Phone:', 'woocommerce' ); ?></th>
				<td><?php echo esc_html( $order->get_billing_phone() ); ?></td>
			</tr>
		<?php endif; ?>

			<tr>
				<th>Адрес доставки:</th>
				<td><?php echo $order->data['billing']['address_1']; ?></td>
			</tr>

		<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

	</table>

</section>
