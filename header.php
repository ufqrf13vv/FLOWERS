<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<div id="wptime-plugin-preloader"></div>
<div class="container">
    <header class="header">
        <div class="header__wrapper">
            <a class="header__logo" href="/">
                <img src="<?php echo get_template_directory_uri(); ?>/img/icons/logo.svg">
            </a>
            <nav class="main-nav">
                <div class="main-nav__block">
                    <button class="main-nav__burger fa fa-bars"></button>
                </div>
                <?php
                wp_nav_menu(array(
                    'container' => '',
                    'menu_class' => 'main-nav__list',
                    'menu_id' => 'main-menu'
                ));
                ?>
            </nav>
            <div class="header__contacts">
                <div class="header__contacts-adress"><?php echo get_option( 'crb_adress' ); ?></div>
                <div class="header__contacts-phone"><i class="fa fa-phone"></i><span><?php echo get_option( 'crb_phone' ); ?></span></div>
            </div>
        </div>
    </header>
</div>
<div class="subheader">
    <div class="container">
        <div class="subheader__wrapper">
            <div class="subheader__triangle"></div>
            <div class="subheader__title">Безрамное остекление в России</div>
        </div>
    </div>
</div>