$(document).ready(function () {

   //-- СЛАЙДЕР ГАЛЕРЕИ  --//
    $('.gallery').slick({
        autoplay: false,
        slidesToShow: 2,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    //-- СЛАЙДЕР ОТЗЫВОВ  --//
   $('.feedback__wrapper').slick({
        autoplay: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    //-- СЛАЙДЕР СЕРТИФИКАТОВ  --//
    $('.certificates__wrapper').slick({
        autoplay: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
            responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                }
            },
            {
                breakpoint: 769,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    //  Мобильное меню
    $('.main-nav__burger').on('click', function() {
        $('.main-nav__list').toggleClass('main-nav__list--active');
    });

    //  Скрол
    $('#scroll').on('click', function() {
        $('body,html').animate({scrollTop:0},800);
    });

    //  Вызов формы заказа обратного звонка
    $('.back-call__btn').on('click', function() {
        $('#back-call').addClass('back-call--active');
        $('#background').addClass('background--active');
    });

    //  Вызов формы расчета
    $('.description__cost').on('click', function(event) {
        event.preventDefault();

        $('#calculate').addClass('calculate--active');
        $('#background').addClass('background--active');
    });

    //  Кнопка закрыть
    $('.back-call__close').on('click', function(event) {
        event.preventDefault();

        $('#back-call').removeClass('back-call--active');
        $('#calculate').removeClass('calculate--active');
        $('#background').removeClass('background--active');
    });

    //  Плавная прокрутка до якоря
    $("#main-menu").on('click', 'a', function(event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;

        $('body,html').animate({scrollTop: (top-30)}, 1500);
    });

    //  Вывод картинок из галереи
    $('.description__example-link').on('click', function(event) {
        event.preventDefault();

        var galleryID = $(this).attr('data-gallery_id');
        var dataNonce = $(this).attr('data-nonce');

        $.ajax({
            type : "GET",
            url: window.wp_data.ajax_url,
            data : {action: "my_action", ID: galleryID, nonce: dataNonce},
            success: function(data) {
                $('#gallery__wrapper').html('');
                $('#gallery__wrapper').append(data);
                $('.gallery__popup').addClass('gallery__popup--active');
                $('#background').addClass('background--active');
                gallerySlider();
            }
        })
    });

    //  Закрыть всплывающее окно
    $('.gallery__close').on('click', function() {
        $('#background').removeClass('background--active');
        $('.gallery__popup').removeClass('gallery__popup--active');
        $('#gallery__wrapper').html('');
        $('.feedback__popup').removeClass('feedback__popup--active');
    });

    $('#background').on('click', function() {
        var background = $('#background'),
            sibling = background.siblings('div[class$="--active"]'),
            classes = sibling.attr('class'),
            classArr = classes.split(' ');

        sibling.removeClass(classArr[1]);
        background.removeClass('background--active');
    });

    //  Полный текст отзыва
    $('.feedback__readmore').on('click', function(event) {
        event.preventDefault();

        var feedbackID = $(this).attr('data-id');
        var dataNonce = $(this).attr('data-nonce');

        $.ajax({
            type : "GET",
            url: window.wp_data.ajax_url,
            data : {action: "feedback", ID: feedbackID, nonce: dataNonce},
            success: function(data) {
                $('#feedback__wrapper').html(data);
                $('.feedback__popup').addClass('feedback__popup--active');
                $('#background').addClass('background--active');
            }
        })
    });

    // СЛАЙДЕР ГАЛЕРЕИ (POP-UP)
    function gallerySlider() {
        var slideNow = 1;
        var slideCount = $('#gallery__wrapper').children().length;
        var slideInterval = 5000;
        var navBtnId = 0;
        var translateWidth = 0;
        var switchInterval = setInterval(nextSlide, slideInterval);

        //  Остановка слайдера при наведении
        $('#gallery__wrapper').hover(function() {
            clearInterval(switchInterval);
        }, function() {
            switchInterval = setInterval(nextSlide, slideInterval);
        });

        $('#next-galleryArrow').click(function() {
            nextSlide();
        });

        $('#prev-galleryArrow').click(function() {
            prevSlide();
        });

        //  Переход на след. слайд
        function nextSlide() {
            if (slideNow == slideCount || slideNow <= 0 || slideNow > slideCount) {
                $('#gallery__wrapper').css('transform', 'translate(0, 0)');
                slideNow = 1;
            } else {
                translateWidth = -$('.gallery__viewport').width() * (slideNow);
                $('#gallery__wrapper').css({
                    'transform': 'translate(' + translateWidth + 'px, 0)',
                    '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                    '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
                });
                slideNow++;
            }
        }

        //  Переход на пред. слайд
        function prevSlide() {
            if (slideNow == 1 || slideNow <= 0 || slideNow > slideCount) {
                translateWidth = -$('.gallery__viewport').width() * (slideCount - 1);
                $('#gallery__wrapper').css({
                    'transform': 'translate(' + translateWidth + 'px, 0)',
                    '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                    '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
                });
                slideNow = slideCount;
            } else {
                translateWidth = -$('.gallery__viewport').width() * (slideNow - 2);
                $('#gallery__wrapper').css({
                    'transform': 'translate(' + translateWidth + 'px, 0)',
                    '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
                    '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
                });
                slideNow--;
            }
        }
    }
    // ----------------------------------------------------------------------------

    var $win = $(window);
    var $marker = $('#company');
    $win.scroll(function() {
        if ($win.scrollTop() + $win.height() >= $marker.offset().top) {
            $win.unbind('scroll');

        }
    });

    //  Переопределение класса
    var originalAddClassMethod = $.fn.addClass;
    //Переопределяем
    $.fn.addClass = function(){
        var result = originalAddClassMethod.apply(this, arguments);
        //Инициализируем событие смены класса
        $(this).trigger('cssClassChanged');
        return result;
    }

    if($(window).width() > 769) {
        sliderAnimation();
    }

    //  Анимация для текста на главном слайдере
    function sliderAnimation() {
        $('.n2-ss-slide').bind('cssClassChanged', function(){
            leftAnimateText('main-slider__title');
            leftAnimateText('main-slider__text');
            $('.main-slider__image').hide();
            $('.main-slider__feature-text').hide();
            $('.main-slider__image').fadeIn(3000);
            $('.main-slider__feature-text').fadeIn(3000);
        });
    }

    function leftAnimateText(className) {
        $('.'+className)
            .animate({
                left: -1000
            }).delay(1700)
            .animate({
                left: 210
            }).delay(3000)
    };
});