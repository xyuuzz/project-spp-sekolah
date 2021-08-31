<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$title}}</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords"
          content="Working Signin form Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    @livewireStyles
    <!-- //Meta tag Keywords -->
    <link href="//fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
    <!--/Style-CSS -->
    <link rel="stylesheet" href="{{asset("assets/login_page_asset/css/style.css")}}" type="text/css" media="all" />
    <link href="{{ asset("assets") }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--//Style-CSS -->

</head>

<body>
<!-- form section start -->
<section class="w3l-workinghny-form">
    <!-- /form -->
    <div class="workinghny-form-grid">
        <div class="wrapper">
            {{$slot}}
        </div>
    </div>
    <!-- //form -->
    <!-- copyright-->
    <div class="copyright text-center">
        <div class="wrapper">
            <p class="copy-footer-29">Design by <a
                    href="https://w3layouts.com">W3layouts</a></p>
        </div>
    </div>
    <!-- //copyright-->
</section>
<!-- //form section start -->


@livewireScripts

</body>

</html>


