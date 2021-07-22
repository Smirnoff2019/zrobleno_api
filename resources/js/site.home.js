

(($) => {
    
    window.owlCarouselInit = function() {
        const $ = jQuery;
    
        $(document).ready(function(){
            const owl = $('#section-1 .owl-carousel');
            
            owl.on('initialized.owl.carousel', function(event) {
                initSliderControllsScopes();
            });

            owl.owlCarousel({
                items: 1,
                loop:true,
                // margin:10,
                video:true,
                // lazyLoad:true,
                center:true,
                // responsive:{
                    // 480:{
                    //     items:2
                    // },
                    // 600:{
                    //     items:4
                    // }
                // },
                nav: false,
                dots: true,
                navContainer: '#section-1 .slider-controls .navs',
                dotsContainer: '#section-1 .slider-controls .dots',
                navText: [
                    `<i class="icon-arrow-left"></i>`,
                    `<i class="icon-arrow-right"></i>`,
                ]
                // dotsEach: true,
            });
            
            initSliderControllsScopes();

            owl.on('changed.owl.carousel', function(event) {
                initSliderControllsScopes();
            });
        });

        function initSliderControllsScopes() {
            const count = $('.slider-controls .dots button').length;
            console.log('count', count)
            let index = $('.slider-controls .dots button.active').index();
            console.log('index', index)
            $('.slider-controls .scopes .total').text(
                +count < 10 ? `0${count}` : count
            );
            $('.slider-controls .scopes .current').text(
                ++index < 10 ? `0${index}` : index
            );
        }
    }

    window.owlCarouselInit();

})(jQuery);