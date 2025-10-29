/*/~~~~~~~~~ banner_swiper Start ~~~~~~~~~~~ /*/
$(".topSlider_wrap").slick({
    centerMode: true,
    // centerPadding: '30px',
    autoplay: true,
    autoplaySpeed: 2500,
    slidesToShow: 1,
});

$(".categoryList").slick({
    centerPadding: "30px",
    infinite: false,
    speed: 800,
    slidesToShow: 6,
    slidesToScroll: 3,
    responsive: [
        {
            breakpoint: 1100,
            settings: {
                centerPadding: "30px",
                infinite: false,
                speed: 800,
                slidesToShow: 4,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 1024,
            settings: {
                centerPadding: "30px",
                infinite: false,
                speed: 800,
                slidesToShow: 3,
                slidesToScroll: 2,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 380,
            settings: {
                slidesToShow: 1.5,
                slidesToScroll: 1,
            },
        },
    ],
});

$(".popularItems_slider").slick({
    infinite: false,
    speed: 1000,
    slidesToShow: 4,
    slidesToScroll: 2,
    responsive: [
        {
            breakpoint: 1100,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
            },
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
            },
        },
    ],
});
