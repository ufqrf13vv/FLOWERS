<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<div class="main-wrapper">
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
                <?php get_product_search_form(); ?>
                <div class="cart">
                    <div class="cart__img"></div><span class="cart__total" id="cart-total"><?php echo WC()->cart->cart_contents_total; ?> РУБ.</span>
                    <?php
                    global $woocommerce;
                    $cart_products = $woocommerce->cart->get_cart(); ?>

                    <div class="cart__block--sublist-wrapper">
                        <div class="cart__block cart__block--sublist">
                            <?php the_widget( 'WC_Widget_Cart' ); ?>
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
