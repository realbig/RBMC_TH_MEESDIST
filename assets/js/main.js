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
})(jQuery);