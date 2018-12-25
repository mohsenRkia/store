<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Store Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="/site/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="/site/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="/site/css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="/site/css/magnific-popup.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="/site/css/flexslider.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="/site/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/site/css/owl.theme.default.min.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="/site/css/bootstrap-datepicker.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="/site/fonts/flaticon/font/flaticon.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="/site/css/style.css">

    <!-- Modernizr JS -->
    <script src="/site/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="/site/js/respond.min.js"></script>
    <![endif]-->

</head>


<body>

<div class="colorlib-loader"></div>

<div id="page">
@include('site.layouts.menu')

@yield('content')

@include('site.layouts.footer')
</div>
<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>


<!-- jQuery -->
<script src="/js/app.js"></script>
<script src="/site/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="/site/js/jquery.easing.1.3.js"></script>

<!-- Waypoints -->
<script src="/site/js/jquery.waypoints.min.js"></script>
<!-- Flexslider -->
<script src="/site/js/jquery.flexslider-min.js"></script>
<!-- Owl carousel -->
<script src="/site/js/owl.carousel.min.js"></script>
<!-- Magnific Popup -->
<script src="/site/js/jquery.magnific-popup.min.js"></script>
<script src="/site/js/magnific-popup-options.js"></script>
<!-- Date Picker -->
<script src="/site/js/bootstrap-datepicker.js"></script>
<!-- Stellar Parallax -->
<script src="/site/js/jquery.stellar.min.js"></script>
<!-- Main -->
<script src="/site/js/main.js"></script>

</body>
</html>

