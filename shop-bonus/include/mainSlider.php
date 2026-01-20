<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.css"/>
<!-- Add the slick-theme.css if you want default styling -->
<link rel="stylesheet" type="text/css"
      href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css"/>
<style type="text/css">
    html, body {
        margin: 0;
        padding: 0;
    }

    * {
        box-sizing: border-box;
    }

    .slider {
        width: 100%;
        margin: 100px auto;
    }

    .slick-slide {
        margin: 0px 20px;
    }

    .slick-slide img {
        width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
    }


    .slick-slide {
        transition: all ease-in-out .3s;
        opacity: .2;
    }

    .slick-active {
        opacity: .5;
    }

    .slick-current {
        opacity: 1;
    }

    .slick-slide img {
        max-height: 400px;
        min-height: 400px;
    }

    @media (max-width: 1500px) {
        .slick-slide img {
            max-height: 300px;
            min-height: 300px;
        }

    }

    @media (max-width: 500px) {
        .slick-slide img {
            max-height: 200px;
            min-height: 200px;
        }


    }
</style>
<section class="center  slider ">
    <div>
        <img src="include/279-retouched__.jpeg">
    </div>
    <div>
        <img src="include/5192974164103929310_.jpeg">
    </div>
    <div>
        <img src="include/5202179468725185123_.jpeg">
    </div>
    <div>
        <img src="include/5393498000946488635_.jpeg">
    </div>
    <div>
        <img src="include/_KVA5719__.jpeg.webp">
    </div>
    <div>
        <img src="include/DSC_5083__.jpeg">
    </div>
    <div>
        <img src="include/DSC_5550__.jpeg">
    </div>

    <div>
        <img src="include/DSCF2700__.jpeg">
    </div>
    <div>
        <img src="include/IMG_3498__.jpeg">
    </div>
    <div>
        <img src="include/IMG_3810__.jpeg">
    </div>
    <div>
        <img src="include/photo_2025-08-22_16-.jpeg">
    </div>
    <div>
        <img src="include/photo_2025-08-22_16-.jpeg.webp">
    </div>
</section>
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('.center').slick({
            autoWidth: true,
            centerMode: true,
            centerPadding: '60px',
            slidesToShow: 3,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: '40px',
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.one-time').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
        $(".vertical-center-4").slick({
            dots: true,
            vertical: true,
            centerMode: true,
            slidesToShow: 4,
            slidesToScroll: 2
        });
        $(".vertical-center-3").slick({
            dots: true,
            vertical: true,
            centerMode: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $(".vertical-center-2").slick({
            dots: true,
            vertical: true,
            centerMode: true,
            slidesToShow: 2,
            slidesToScroll: 2
        });
        $(".vertical-center").slick({
            dots: true,
            vertical: true,
            centerMode: true,
        });
        $(".vertical").slick({
            dots: true,
            vertical: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $(".regular").slick({
            dots: true,
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3
        });
        $(".center").slick({
            dots: true,
            infinite: true,
            centerMode: true,
            slidesToShow: 5,
            slidesToScroll: 3
        });
        $(".variable").slick({
            dots: true,
            infinite: true,
            variableWidth: true
        });
        $(".lazy").slick({
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true
        });
        $('.variable-width').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            centerMode: true,
            variableWidth: true
        });
    });
</script>