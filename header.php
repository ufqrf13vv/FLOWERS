<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__wrapper">
                <a class="logo" href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/header_logo.png"></a>
                <?php
                wp_nav_menu(array(
                    'container'  => '',
                    'menu_class' => 'header-menu',
                    'menu_id'    => 'header-menu',
                    'theme_location'  => 'main-menu'
                ));
                ?>
                <?php the_widget( 'WP_Widget_Search' ); ?>
                <div class="cart">
                    <div class="cart__img"></div><span class="cart__total"><?php echo WC()->cart->cart_contents_total; ?> РУБ.</span>
                    <?php
                    global $woocommerce;
                    $cart_products = $woocommerce->cart->get_cart(); ?>

                    <div class="cart__block--sublist-wrapper">
                        <div class="cart__block cart__block--sublist">
                            <div class="cart__block-header">Корзина</div>
                            <?php foreach ($cart_products as $item => $product) { ?>
                                <div class="cart__block-row cart__block-row--product">
                                    <div class="cart__block-product_image">
                                        <?php echo get_the_post_thumbnail( $product['product_id'], array(63, 63), '' ); ?>
                                    </div>
                                    <div class="cart__block-product_title"><?php echo $product['data']->name; ?></div>
                                    <div class="cart__block-product_buttons">
                                        <button class="cart__block-product_btn cart__block-product_btn--plus"></button>
                                        <input type="text" class="cart__block-product_input" placeholder="1" value="<?php echo $product['quantity']; ?>">
                                        <button class="cart__block-product_btn cart__block-product_btn--minus"></button>
                                    </div>
                                    <div class="cart__block-product_sum"><?php echo number_format($product['line_total'], 0, '', ','); ?> руб.</div>
                                </div>
                            <?php } ?>
                            <div class="cart__block-product_block">
                                <div class="cart__block-row">
                                    <div class="cart__block-product_title">Подитог</div>
                                    <div class="cart__block-product_sum"><?php echo number_format(WC()->cart->subtotal, 0, '', ','); ?> руб.</div>
                                </div>
                                <div class="cart__block-row">
                                    <div class="cart__block-product_title">Самовывоз из магазина</div>
                                    <div class="cart__block-product_sum">0 руб.</div>
                                </div>
                                <div class="cart__block-row">
                                    <div class="cart__block-product_title">Итого</div>
                                    <div class="cart__block-product_sum"><?php echo number_format(WC()->cart->cart_contents_total, 0, '', ','); ?> руб.</div>
                                </div>
                                <a class="cart__block-order" href="">Оформить заказ</a>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="cards">
                    <li class="cards__item cards__item--maestro"></li>
                    <li class="cards__item cards__item--visa"></li>
                </ul>
                <ul class="contacts">
                    <li class="contacts__item"><?php echo get_option( 'crb_phone1' ); ?></li>
                    <li class="contacts__item"><?php echo get_option( 'crb_phone2' ); ?></li>
                </ul>
            </div>
        </div>
    </header>
    <div class="submenu">
        <div class="container">
            <?php
            wp_nav_menu(array(
                'container'  => '',
                'menu_class' => 'submenu__list',
                'menu_id'    => 'submenu',
                'theme_location'  => 'categories-menu'
            ));
            ?>
        </div>
    </div>
