(function ($) {
    $(document).ready(function () {
 
        //  Главный слайдер
        $('.main-slider').slick({
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
        });

        //  Слайдер новостей
        $('.news__wrapper').slick({
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
        });

         //  Слайдер отзывов
        $('.feedbacks__slider').slick({
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3,
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

        arrows();

        function arrows() {
            $('.slick-arrow').html('');
            $('.slick-prev').addClass('fa').addClass('fa-angle-double-left');
            $('.slick-next').addClass('fa').addClass('fa-angle-double-right');
        }

        //  Показать контактную информацию
        $('.contacts__title').on('click', function() {
            $(this).siblings('.contacts__item-wrap').show('slow');
        });

        //  Скрыть контактную информацию
        $('.contacts__hide').on('click', function() {
            $(this).closest('.contacts__item-wrap').hide('slow');
        });

        //  Фильтр
        $('.catalog__filter input').on('change', function() {
            var price_from = $('#form_filter input[name="price-from"]').val();
            var price_to = $('#form_filter input[name="price-to"]').val();
            var sort = $('#form_filter input[name="sort"]:checked').val();
            var count = $('#form_filter input[name="count"]:checked').val();
            var cat_id = $('#category-attr').attr('data-id');
            var cat_slug = $('#category-attr').attr('data-slug');
            var colors = [];

            $( '.catalog__filter-list-wrapper--colors input[type="checkbox"]').each( function( index, element) {
                if($(element).prop('checked')) {
                    var element = $(element).val();
                    colors.push(element);
                }
            });

            $.ajax({
                type : "POST",
                url: window.wp_data.ajax_url,
                data : {
                    action: "filter",
                    price_from: price_from,
                    price_to: price_to,
                    sort: sort,
                    count: count,
                    slug: colors,
                    cat_slug: cat_slug,
                    cat_id: cat_id
                },
                success: function(data) {
                    $('#catalog__wrapper').html('');
                    $('#catalog__wrapper').html(data);
                }
            })
        });
        //---  Фильтр ---//

        //  Полный текст отзыва
        $('.feedbacks__readmore').on('click', function() {
            var post_id = $(this).attr('data-postid');

            $.ajax({
                type : "POST",
                url: window.wp_data.ajax_url,
                data : {
                    action: "feedback",
                    post_id: post_id
                },
                success: function(data) {
                    $('#feedback_popup').addClass('feedback__popup--active');
                    $('#background').addClass('background--active');
                    
                    $('#feedback_popup').html('');
                    $('#feedback_popup').html(data);
                }
            })
        });

        //  КНОПКИ + -
        $('.cart__block--sublist-wrapper, #order_review').on('click', '.cart__block-product_btn--plus, .cart__block-product_btn--minus', function (event) {
            event.preventDefault();

            var sibling = $(this).siblings('.cart__block-product_input');
            var hash = $(this).attr('data-product_id');
            var quantity = parseInt(sibling.val());
            var cost = parseInt($('#shipping-cost').text());

            if ($(this).hasClass('cart__block-product_btn--plus')) {
                calculate(sibling, 'plus');
                updateCart(quantity + 1, hash, cost);
            } else {
                if (quantity > 1) {
                    calculate(sibling, 'minus');
                    updateCart(quantity - 1, hash, cost);
                }
            }
        });

        $('.product__item-btn').on('click', function (event) {
            event.preventDefault();

            var sibling = $(this).siblings('.product__item-num');
            var quantity = parseInt(sibling.val());

            if ($(this).hasClass('product__item-btn_plus')) {
                calculate(sibling, 'plus');
            } else {
                if (quantity > 1) {
                    calculate(sibling, 'minus');
                }
            }
        });

        function calculate(sibling, sign) {
            var count;

            count = sibling.val();

            if (sign == 'plus') {
                sibling.val(Number(count) + 1);
            } else {
                if (count > 1) {
                    sibling.val(Number(count) - 1);
                }
            }
        };
        //---  КНОПКИ + - ---//

        //  Замена миниатюры в товаре
        $('.cart__block-product_image').on('click', function () {
            var new_src = $(this).attr('data-src');
            var img_parent = $(this).parent('.product__item-wrapper');
            var main_image = img_parent.siblings('#product__main-image').children('img').attr('src');

            $('#product__main-image').children('img').attr('src', new_src);
            $(this).attr('src', main_image);
        });
        //--- Замена миниатюры в товаре ---//

        //  ПОИСК
        $('#woocommerce-product-search-field-0').on('input', function () {
            var search_text = $(this).val().trim();

            if (search_text.length >= 2) {
                search(search_text);
            }

        });

        function search(text) {
            $.ajax({
                type : "POST",
                url: window.wp_data.ajax_url,
                data : {
                    action: "search",
                    text: text
                },
                success: function(data) {
                    $('#search-list').html('');
                    $('#search-list').html(data);
                    $('.search-list__wrapper').addClass('search-list__wrapper--active');
                }
            })
        }

        $('#search-list').on('click', '.search-list__link', function () {
            var search_text = $(this).text();

            $('#woocommerce-product-search-field-0').val(search_text);
            $(this).parents('.search-list__wrapper').removeClass('search-list__wrapper--active');
        });
        //--- ПОИСК ---//

        //  Заказать в 1 клик
        $('#catalog__wrapper, .product__item').on('click', '.one-click__link', function() {
            var title = $(this).attr('data-title');

            $('#one-click__title').html('Купить ' + title);
            $('#one-click_productname').val(title);
            activeForm('one-click');
        });
        //--- Заказать в 1 клик ---//

        //  Заказать обратный звонок
        $('#btn_back-call').on('click', function() {
            activeForm('back-call');
        });

        function activeForm(formName) {
            $('#' + formName).addClass('one-click--active');
            $('#background').addClass('background--active');
        }
        //--- Заказать обратный звонок ---//

        //  Скрыть активные формы
        $('#background, .add-to-cart__link--exit').on('click', function() {
            var background = $('#background'),
                sibling = background.siblings('div[class$="--active"]'),
                classes = sibling.attr('class'),
                classArr = classes.split(' ');

            classArr.forEach(function(item, i) {
                if (~item.indexOf("active")) {
                    sibling.removeClass(classArr[i]);
                }
            });
            background.removeClass('background--active');
        });
        //--- Скрыть активные формы ---//

        //  Скрол
        $('#scroll').on('click', function() {
            $('body,html').animate({scrollTop:0},800);
        });
        //--- Скрол ---//

        //  Обновление корзины
        function updateCart(quantity, hash, cost) {

            $.ajax({
                type : "POST",
                url: window.wp_data.ajax_url,
                data : {
                    action: "updatecart",
                    quantity: quantity,
                    hash: hash,
                    cost: cost
                },
                success: function(data) {
                    var result = $.parseJSON(data);

                    $('#product-count').val(result.quantity);
                    $('#product-subtotal').html(result.subtotal + ' руб.');
                    $('#cart-total').html(result.subtotal + ' РУБ.');
                    $('#order-total_sum').html(result.total + ' РУБ.');
                }
            })
        }
        //--- Обновление корзины ---//

        //  Изменение способа доставки и общей суммы заказа
        $('input.shipping_method').on('change', function() {
            var methodID = $(this).val(),
                methodCost = parseInt($(this).attr('data-cost')),
                methodName = $(this).siblings('label').text(),
                subTotal = parseInt($('#product-subtotal').attr('data-subtotal')),
                totalSum = subTotal + methodCost,
                result = (totalSum+'').replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

            $('#shipping-name').html(methodName);
            $('#shipping-cost').html(methodCost + ' руб.');
            $('#order-total_sum').html(result + ' руб.');
        });
        //--- Изменение способа доставки и общей суммы заказа ---//

        //  Добавление товара в корзину
        $('.catalog__item-incart').on('click', function () {
            add_popup();
        });

        function add_popup() {
            $('.add-to-cart__wrapper').addClass('add-to-cart__wrapper--active');
            $('#background').addClass('background--active');
        }

        $('.product__item-link--submit').on('click', function (event) {
            event.preventDefault();

            var product_id = $(this).val();
            var quantity = $('.product__item-num').val();

            add_product(product_id, quantity);
            add_popup();
        });

        function add_product(product_id, quantity) {
            $.ajax({
                type : "POST",
                url: window.wp_data.ajax_url,
                data : {
                    action: "addproduct",
                    product_id: product_id,
                    quantity: quantity
                },
                success: function(data) {
                    $('.widget_shopping_cart_content').html('');
                    $('.widget_shopping_cart_content').html(data);

                    var subtotal = parseInt($('#product-subtotal').text());
                    $('#cart-total').html(subtotal + ' РУБ.');
                }
            })
        }
        //--- Добавление товара в корзину ---//

        $('.cart__block--sublist').on('click', '.remove', function (event) {
            event.preventDefault();

            var product_id = $(this).attr('data-product_id');
            remove_product(product_id);
        });

        function remove_product(product_id) {
            $.ajax({
                type : "POST",
                url: window.wp_data.ajax_url,
                data : {
                    action: "removeproduct",
                    product_id: product_id
                },
                success: function(data) {
                    $('.widget_shopping_cart_content').html('');
                    $('.widget_shopping_cart_content').html(data);

                    var subtotal = parseInt($('#product-subtotal').text());
                    var title = $('.cart__block-header').siblings('.cart__block-product_title').text();

                    if (title) {
                        $('#cart-total').html('0 РУБ.');
                    } else {
                        $('#cart-total').html(subtotal + ' РУБ.');
                    }
                }
            })
        }
    });
})(jQuery);