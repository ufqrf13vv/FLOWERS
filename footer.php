<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">
            <div class="logo logo--footer"><img src="<?php echo get_template_directory_uri(); ?>/img/footer_logo.png"></div>
            <div class="footer__block">
                <?php
                wp_nav_menu(array(
                    'container'  => '',
                    'menu_class' => 'header-menu header-menu--footer',
                    'menu_id'    => 'header-menu',
                    'theme_location'  => 'main-menu'
                ));
                ?>
                <div class="footer__copyright"><?php echo get_option( 'crb_footer' ); ?></div>
            </div>
            <ul class="contacts contacts--footer">
                <li class="contacts__item"><?php echo get_option( 'crb_phone1' ); ?></li>
                <li class="contacts__item"><?php echo get_option( 'crb_phone2' ); ?></li>
            </ul>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>