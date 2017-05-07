(function ($) {
    $(document).ready(function () {
 
        //  Слайдер
        $('.main-slider').slick({
            autoplay: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
        });

        //  Слайдер
        $('.news__wrapper').slick({
            autoplay: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true
        });

         //  Слайдер
        $('.feedbacks__slider').slick({
            autoplay: true,
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

        $('.catalog__filter input').on('change', function() {
            var price_from = $('#form_filter input[name="price-from"]').val();
            var price_to = $('#form_filter input[name="price-to"]').val();
            var sort = $('#form_filter input[name="sort"]:checked').val();
            var count = $('#form_filter input[name="count"]:checked').val();
            var cat_id = $('#form_filter input[name="category-id"]').val();

            $( '.catalog__filter-list-wrapper--colors input[type="checkbox"]').each( function( index, element) {
                //console.log($(element).prop('checked'));
                if($(element).prop('checked')) {
                    console.log($(element).val());
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
                    slug: ['color-1', 'color-2'],
                    cat_id: cat_id,
                },
                success: function(data) {
                    //$('#catalog__wrapper').html('');
                    //$('#catalog__wrapper').html(data);
                    //console.log(data);
                }
            })
        });

        //  Плюс - минус
        $('.cart__block-product_btn--plus, .cart__block-product_btn--minus').on('click', function (event) {
            event.preventDefault();

            var sibling,
                sign;

            sibling = $(this).siblings('.cart__block-product_input');
            if ($(this).hasClass('cart__block-product_btn--plus')) {
                calculate(sibling, 'plus');
            } else {
                calculate(sibling, 'minus');
            }
        });

        function calculate(sibling, sign) {
            var count;

            count = sibling.val();

            if (sign == 'plus') {
                sibling.val(Number(count) + 1);
            } else {
                if (count > 0) {
                    sibling.val(Number(count) - 1);
                }
            }
        };

        //  Замена миниатюры в товаре
        $('.cart__block-product_image').on('click', function () {
            var new_src = $(this).attr('data-src');
            var img_parent = $(this).parent('.product__item-wrapper');
            var main_image = img_parent.siblings('#product__main-image').children('img').attr('src');

            $('#product__main-image').children('img').attr('src', new_src);
            $(this).attr('src', main_image);
        });
    });
})(jQuery);