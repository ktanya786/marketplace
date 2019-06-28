        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2019 Klera, LLC. All Rights Reserved. | <a href="https://klera.io/privacy-policy" target="_blank">Privacy Policy</a></p>
        </div>
        
        <a href="javascript:void(0)" id="back-to-top" title="Back to top">
            <!-- &uarr; -->
            <i class="fas fa-arrow-up"></i>
        </a>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        
        <script src="script.js" type="text/javascript"></script>
        <script src="js/menu.js" type="text/javascript"></script>
        <script src="js/ResizeSensor.js" type="text/javascript"></script>
        <script src="js/sticky-sidebar-scroll.min.js" type="text/javascript"></script>
        <script src="js/owl.carousel.min.js" type="text/javascript"></script>
        <script src="js/jquery.multiselect.js" type="text/javascript"></script>
        <!-- <script src="vizjs/dagree.js"></script> -->
        <!-- <script src="vizjs/vis.js"></script>
        <script src="app/graphrenderer.js"></script> -->
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
        <script>
            
        $(document).ready(function(){
            
           // Back to top
           if ($('#back-to-top').length) {
    var scrollTrigger = 200, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
            }
        };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('#back-to-top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
     
            $(".navigation").dropdowns();

            $('.template-carousel').owlCarousel({
                loop:false,
                margin:10,
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:false
                    },
                    600:{
                        items:2,
                        nav:false
                    },
                    1000:{
                        items:4,
                        nav:false,
                        loop:false
                    }
                }
            });

            $('.single-carousel').owlCarousel({
                loop:true,
                margin:10,
                responsiveClass:true,
                items:1,
                dots: false,
                nav: true,
                mouseDrag: false,
            });
            
            /*Fancybox */

            $('[data-fancybox="gallery"]').fancybox({
                buttons : ['close'],
            });

            $(window).scroll(function() {    
                var scroll = $(window).scrollTop();

                //>=, not <=
                if (scroll >= 10) {
                    //clearHeader, not clearheader - caps H
                    $("body").addClass("searchremoved");
                }
                else {
                    $("body").removeClass("searchremoved");
                }
            }); //missing );

            $(document).ready(function(){
                $('.search-hold-filter').removeClass("active");
                
                $(".show-bar").click(function(){
                    $('.search-hold-filter').removeClass("active");
                    $(this).parent('.search-hold-filter').addClass("active");
                })

                $(".hide-bar").click(function(){
                    $(this).parent('.search-hold-filter').removeClass("active");
                })
            })
            
            //Sticky Sidebar
            $('#filters').stickySidebar({
                containerSelector: '#wrapper',
                innerWrapperSelector: '.filters_inr',
                topSpacing: 60,
                bottomSpacing: 60
            });

        });
        </script>
    </body>
</html>