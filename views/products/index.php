<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link
          rel="shortcut icon"
          href="../public/images/favicon.png"
          type=""
  >

  <title> the Бык </title>

  <!-- bootstrap core css -->
  <link
          rel="stylesheet"
          type="text/css"
          href="../public/css/bootstrap.css"
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
          href="../public/css/font-awesome.min.css"
          rel="stylesheet"
  />

  <!-- Custom styles for this template -->
  <link
          href="../public/css/style.css" rel="stylesheet"
  />
  <!-- responsive style -->
  <link
          href="../public/css/responsive.css" rel="stylesheet"
  />

    <!-- jQery -->
    <script
            src="../public/js/jquery-3.4.1.min.js"
    ></script>
    <!-- popper js -->
    <script
            src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"
    ></script>
    <!-- bootstrap js -->
    <script
            src="../public/js/bootstrap.js"
    ></script>
    <!-- owl slider -->
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    ></script>
    <!-- isotope js -->
    <script
            src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"
    ></script>
    <!-- nice select -->
    <script
            src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
    ></script>
    <!-- custom js -->
    <script
            src="../public/js/custom.js"
    ></script>



</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="../public/images/hero-bg.jpg" alt="">
    </div>

    <!-- header section strats -->
   <?php require_once VIEW_ROOT. '/header.php'?>
    <!-- end header section -->
  </div>

  <!-- food section -->
  <?php require_once VIEW_ROOT . '/products/products.php' ?>
  <!-- end food section -->

  <!-- footer section -->
 <?php require_once VIEW_ROOT. 'footer.php'?>
  <!-- footer section -->


</body>

</html>