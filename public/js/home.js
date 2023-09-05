$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip({html: true});
});

$('.slider-container').slick({
    prevArrow: '<img  class = "prev" src="../images/next.svg" alt="">',
    nextArrow: '<img  class = "next" src="../images/next.svg" alt="">',
    dots: false,
    infinite: false,
    speed: 300,
    responsive: [
        {
            breakpoint: 4032,
            settings: {
                slidesToShow: 10,
                slidesToScroll: 4,
            }
        },
        {
            breakpoint: 3648,
            settings: {
                slidesToShow: 9,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 3264,
            settings: {
                slidesToShow: 8,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 2880,
            settings: {
                slidesToShow: 7,
                slidesToScroll: 3,
            }
        },
        {
            breakpoint: 2496,
            settings: {
                slidesToShow: 6,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 2112,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 2,
            }
        },
        {
            breakpoint: 1728,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 1,
            }
        },
        {
            breakpoint: 1344,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
            }
        }
    ]
});





