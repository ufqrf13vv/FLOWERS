</div>
<footer class="footer">
    <div class="container">
        <div class="footer__wrapper">
            <div class="logo logo--footer"><img src="<?php echo get_template_directory_uri(); ?>/img/footer_logo.png">
            </div>
            <div class="footer__block">
                <?php
                wp_nav_menu(array(
                    'container' => '',
                    'menu_class' => 'header-menu header-menu--footer',
                    'menu_id' => 'header-menu',
                    'theme_location' => 'main-menu'
                ));
                ?>
                <div class="footer__copyright"><?php echo get_option('crb_footer'); ?></div>
            </div>
            <ul class="contacts contacts--footer">
                <li class="contacts__item"><?php echo get_option('crb_phone1'); ?></li>
                <li class="contacts__item"><?php echo get_option('crb_phone2'); ?></li>
            </ul>
        </div>
    </div>
</footer>
<!-- Фон для форм -->
<div class="background" id="background"></div>
<!-- Купить в 1 клик-->
<div class="one-click" id="one-click">
    <?php echo do_shortcode('[contact-form-7 id="124" title="Купить в 1 клик"]'); ?>
</div>
<!-- Заказ обратного звонка -->
<div class="one-click one-click--call" id="back-call">
    <div class="one-click__header">Заказ обратного звонка</div>
    <div class="one-click__row">
        <input type="text" class="one-click__input one-click__input--call" placeholder="Введите Ваш телефон">
        <div class="one-click__submit-wrapper">
            <input type="text" class="one-click__submit one-click__submit--call" value="Жду звонка!">
            <i class="fa fa-phone" aria-hidden="true"></i>
        </div>
    </div>
    <div class="one-click__text">Наш оператор позвонит Вам и проконсультирует по всем вопросам!<br><span>* Звонок бесплатный</span>
    </div>
</div>
<!-- Обратный звонок -->
<div class="back-call__wrapper">
    <button class="back-call__btn" id="btn_back-call">
        <i class="fa fa-phone"></i>
    </button>
</div>
<!-- Полный текст отзыва -->
<div class="feedback__popup" id="feedback_popup"></div>
<!-- Скролл -->
<div class="up__block">
    <button class="up__btn" id="scroll"></button>
</div>
<!-- Товар добавлен в корзину -->
<div class="add-to-cart__wrapper">
    <div class="add-to-cart__header">Ваш товар добавлен в корзину!</div>
    <div class="add-to-cart__buttons">
        <a href="<?php echo WC()->cart->get_cart_url(); ?>" class="add-to-cart__link">Перейти в корзину</a>
        <a href="javascript:void(0);" class="add-to-cart__link add-to-cart__link--exit">Продолжить выбор</a>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>