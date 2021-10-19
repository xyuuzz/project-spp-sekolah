<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title> {{$title}} </title>
    <meta content="laman pembayaran spp siswa sekolah mantab jiwa 02" name="description">
    <meta content="pembayaran spp siswa sekolah mantab jiwa 02" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset("assets") }}/img/favicon.png" rel="icon">
    <link href="{{ asset("assets") }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    @livewireStyles
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="{{ asset("assets/css/custom.css") }}">
    <link href="{{ asset("assets/vendor/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/icofont/icofont.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/boxicons/css/boxicons.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/animate.css/animate.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/remixicon/remixicon.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/line-awesome/css/line-awesome.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/venobox/venobox.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/owl.carousel/assets/owl.carousel.min.css") }}" rel="stylesheet">
    <link href="{{ asset("assets/vendor/aos/aos.css") }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset("assets/css/style.css") }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    @if(! request()->routeIs("student"))
        <link rel="stylesheet" href="{{asset("assets/pagination_asset/ionicons/css/_ionicons.scss")}}">
        <link rel="stylesheet" href="{{asset("assets/pagination_asset/css/style.css")}}">
    @endif

    @if(request()->routeIs("teacher_report"))
        <link href="{{ asset("assets/css/card_list_report_teacher/style.css") }}" rel="stylesheet">
    @endif

    @yield("custom_css")
</head>

<body>
@include("template.header")

@include("hero.main")
<main id="main">
      {{$slot}}
</main>

@include("template.footer")

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>

@livewireScripts

<!-- Vendor JS Files -->
<script src="{{ asset("assets") }}/vendor/jquery/jquery.min.js"></script>
<script src="{{ asset("assets") }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset("assets") }}/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="{{ asset("assets") }}/vendor/php-email-form/validate.js"></script>
<script src="{{ asset("assets") }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="{{ asset("assets") }}/vendor/venobox/venobox.min.js"></script>
<script src="{{ asset("assets") }}/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="{{ asset("assets") }}/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="{{ asset("assets") }}/js/main.js"></script>

<script src="{{asset("assets/pagination_asset/js/main.js")}}"></script>
@yield("custom_js")
</body>

</html>
