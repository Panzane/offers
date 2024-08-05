define([
    'jquery',
    'jquery/ui',
    'slick'
], function($){
    $.widget('mage.offerSlider', {
        /**
         * Widget initialization
         * @private
         */
        _create: function() {
            $(this.element).slick({
                dots: false,
                infinite: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false
            });
        }
    });

    return $.mage.offerSlider;
});
