jQuery(function ($) {
    $(document).ready(function () {
        var owl = $('.km-gifted-testimonials');
        owl.owlCarousel({
            items: 3,
            dots: false,
            loop: true,
            responsiveClass:true,
            responsive: {
                0:{
                    items: 1
                },
                640:{
                    items: 2
                },
                940:{
                    items: 3
                }
            }
        });

        $('.km-gifted-control-next').click(function () {
            owl.trigger('next.owl.carousel');
        });
// Go to the previous item
        $('.km-gifted-control-prev').click(function () {
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            owl.trigger('prev.owl.carousel', [300]);
        });
    });

});