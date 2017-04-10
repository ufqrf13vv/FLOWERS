<footer class="footer" xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="footer__logo"><img src="<?php echo get_template_directory_uri(); ?>/img/bksfooter-logo.png"></div>
        <div class="footer__copyright"><?php echo get_option( 'crb_footer' ); ?></div>
    </div>
</footer>
<div class="back-call__block">
    <button class="back-call__btn">
        <i class="fa fa-phone"></i>
    </button> 
</div>
<div class="up__block">
    <button id="scroll" class="up__btn"></button>
</div>
<!-- Фон для всплывающих форм -->
<div id="background" class="background"></div>
<!-- Форма обратного звонка -->
<div id="back-call" class="back-call">
    <?php echo do_shortcode('[contact-form-7 id="166"]'); ?>
</div>

<!-- Форма рассчета стоимости -->
<div id="calculate" class="calculate">
    <?php echo do_shortcode('[contact-form-7 id="167"]'); ?>
</div>

<!-- Попап картинок галереи -->
<div class="gallery__popup">
    <button class="gallery__close"></button>
    <div class="gallery__viewport">
        <div class="gallery__wrapper" id="gallery__wrapper">
            
        </div>
    </div>
    <div class="gallery__arrows">
        <div id="prev-galleryArrow"></div>
        <div id="next-galleryArrow"></div>
    </div>
</div>

<!-- Попап отзыва -->
<div class="feedback__popup">
    <button class="gallery__close"></button>
    <div class="feedback__popup-wrapper" id="feedback__wrapper"></div>
</div>

<?php wp_footer(); ?>
</body>
</html>