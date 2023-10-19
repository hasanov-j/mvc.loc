<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link
            rel="shortcut icon"
            href="/public/images/favicon.png"
            type="">

    <title> the бык </title>

    <!-- bootstrap core css -->
    <link
            rel="stylesheet"
            type="text/css"
            href="/public/css/bootstrap.css"
    />

    <!--owl slider stylesheet -->
    <link
            rel="stylesheet"
            type="text/css"
            href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    />
    <!-- nice select  -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
            integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
            crossorigin="anonymous"
    />
    <!-- font awesome style -->
    <link
            href="/public/css/font-awesome.min.css"
            rel="stylesheet"
    />

    <!-- Custom styles for this template -->
    <link
            href="/public/css/style.css"
            rel="stylesheet"
    />
    <!-- responsive style -->
    <link
            href="/public/css/responsive.css"
            rel="stylesheet"
    />

    <!-- jQery -->
    <script src="../../public/js/jquery-3.4.1.min.js"></script>

    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <!-- bootstrap js -->
    <script src="../../public/js/bootstrap.js"></script>

    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>

    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>

    <!-- custom js -->
    <script src="../../public/js/custom.js"></script>

    <!-- vue js -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>

    <!--axios-->
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>

</head>

<body>

<div class="hero_area">
    <div class="bg-box">
        <img src="/public/images/the_bull.jpg" alt="">
    </div>
    <!-- header section strats -->
    <?php require_once VIEW_ROOT . 'header.php'; ?>
    <!-- end header section -->
    <!-- slider section -->
    <?php require_once VIEW_ROOT . 'main/slider.php'; ?>
    <!-- end slider section -->
</div>

<!-- offer section -->

<!-- end offer section -->

<!-- food section -->
<section class="food_section layout_padding">


    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Меню
            </h2>
        </div>

        <div class="filters-content">
            <div class="row grid">
                <div id="app-product" class="container">
                    <product-view></product-view>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end food section -->

<!-- about section -->
<?php require_once VIEW_ROOT . 'about/about.php'; ?>
<!-- end about section -->

<!-- book section -->
<section class="book_section layout_padding">

    <div id="app-book" class="container">

        <div class="row">
            <div class="col-md-12">
                <book-store></book-store>
            </div>
        </div>
    </div>

</section>
<!-- end book section -->

<!-- client section -->

<!-- end client section -->

<!-- footer section -->
<?php require_once VIEW_ROOT . 'footer.php'; ?>
<!-- footer section -->

</body>

</html>