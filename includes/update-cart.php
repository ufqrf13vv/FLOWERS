<?php
add_action( 'wp_ajax_updatecart', 'updatecart_callback' );
add_action( 'wp_ajax_nopriv_updatecart', 'updatecart_callback' );

//  Обновление маленькой корзины в хедере
function updatecart_callback()
{
    $hash = $_REQUEST['hash'];
    $quantity = $_REQUEST['quantity'];
    $cost = $_REQUEST['cost'];

    WC()->cart->set_quantity( $hash, $quantity, true );

    $product = WC()->cart->get_cart()[$hash];
    $subtotal = WC()->cart->cart_contents_total;

    $result['quantity'] = $product['quantity'];
    $result['subtotal'] = number_format($subtotal, 0, ',', ' ');
    $result['total'] = number_format($subtotal + $cost, 0, ',', ' ');

    echo json_encode($result);

    wp_die();
}

add_action( 'wp_ajax_addproduct', 'addproduct_callback' );
add_action( 'wp_ajax_nopriv_addproduct', 'addproduct_callback' );

//  Добаление товара в корзину
function addproduct_callback() {
    global $woocommerce;

    if (isset($_REQUEST['product_id'])) {
        $product_id = (int)$_REQUEST['product_id'];
    }

    if (isset($_REQUEST['quantity'])) {
        $quantity = (int)$_REQUEST['quantity'];
    }

    $woocommerce->cart->add_to_cart( $product_id, $quantity );

    echo update_cart();

    wp_die();
}

add_action( 'wp_ajax_removeproduct', 'removeproduct_callback' );
add_action( 'wp_ajax_nopriv_removeproduct', 'removeproduct_callback' );

//  Обновление маленькой корзины в хедере
function removeproduct_callback()
{
    if (isset($_REQUEST['product_id'])) {
        $product_id = (int)$_REQUEST['product_id'];
    }

    $cart = WC()->instance()->cart;
    $cart_id = $cart->generate_cart_id($product_id);
    $cart_item_id = $cart->find_product_in_cart($cart_id);
    if($cart_item_id){
        $cart->set_quantity($cart_item_id,0);
    }

    echo update_cart();

    wp_die();
}

function update_cart() { ?>
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
                        <a href="javascript:void(0);" class="remove" data-product_id="<?php echo $product_id; ?>"></a>
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
    <?php endif;
}