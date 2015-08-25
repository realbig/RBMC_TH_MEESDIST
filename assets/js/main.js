/**
 Main functions file.

 @since 0.1.0
 @package MeesDist
 */
(function ($) {
    'use strict';

    $(document).foundation({
        abide: {
            validate_on_blur: false,
            focus_on_invalid: false
        }
    });

    // Slick slider
    if ($().slick) {
        $(function () {
            $('.slick-slider').slick({
                dots: true,
                nextArrow: false,
                prevArrow: false,
                autoplay: true
            });
        });
    }

    // Hide link for empty cats
    $('ul.product-categories').find('li').each(function () {

        var $count = $(this).find('span.count'),
            count;

        if ($count.html()) {
            count = parseInt($count.html().match(/\d/));
        }

        $count.remove();

        if (count === 0) {
            $(this).find('a').click(function (event) {
                event.preventDefault();
                return false;
            });
        }
    });
})(jQuery);