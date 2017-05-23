<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
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
 * @version 2.5.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

?>

<?php do_action('woocommerce_before_mini_cart'); ?>

<div class="cart__block-header">Корзина</div>

<?php if (!WC()->cart->is_empty()) : ?>

    <?php do_action('woocommerce_before_mini_cart_contents'); ?>

    <?php
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
            $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
            $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
            $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>
            <div class="cart__block-row cart__block-row--product">
                <?php echo WC()->cart->get_item_data($cart_item); ?>
                <a class="cart__block-product_image" href="<?php echo esc_url($product_permalink); ?>">
                    <?php echo $thumbnail; ?>
                </a>
                <div class="cart__block-product_title"><?php echo $product_name; ?></div>
                <div class="cart__block-product_buttons">
                    <button class="cart__block-product_btn cart__block-product_btn--plus" data-product_id="<?php echo $cart_item_key; ?>">
                    </button>
                    <input type="text" class="cart__block-product_input" placeholder="1" id="product-count" value="<?php echo $cart_item['quantity']; ?>">
                    <button class="cart__block-product_btn cart__block-product_btn--minus" data-product_id="<?php echo $cart_item_key; ?>">
                    </button>
                    <a href="javascript:void(0);" class="remove" data-product_id="<?php echo $product_id; ?>">х</a>
                </div>
                <div class="cart__block-product_sum" id="line-total"><?php echo $product_price; ?> руб.</div>
            </div>
            <?php
        }
    }
    ?>

    <?php do_action('woocommerce_mini_cart_contents'); ?>

<?php else : ?>

    <div class="cart__block-product_title"><?php _e('No products in the cart.', 'woocommerce'); ?></div>

<?php endif; ?>

<?php if (!WC()->cart->is_empty()) : ?>

    <div class="cart__block-product_block">
        <div class="cart__block-row">
            <div class="cart__block-product_title"><?php _e('Subtotal', 'woocommerce'); ?></div>
            <div class="cart__block-product_sum" id="product-subtotal"><?php echo WC()->cart->subtotal; ?>
                руб.
            </div>
        </div>
        <a class="cart__block-order" href="<?php echo WC()->cart->get_cart_url(); ?>">Оформить заказ</a>
    </div>
<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>
