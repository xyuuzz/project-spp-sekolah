<div>
    <!--
    Author: W3layouts
    Author URL: http://w3layouts.com
    -->
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <title>Login Page</title>
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
        <!--//Style-CSS -->
    </head>

    <body>
    <!-- form section start -->
    <section class="w3l-workinghny-form">
        <!-- /form -->
        <div class="workinghny-form-grid">
            <div class="wrapper">
                <div class="logo">
                    <h1>Halaman Login</h1>
                    <!-- if logo is image enable this
                        <a class="brand-logo" href="#index.html">
                            <img src="image-path" alt="Your logo" title="Your logo" style="height:35px;" />
                        </a> -->
                </div>
                <div class="workinghny-block-grid">
                    <div class="workinghny-left-img align-end">
                        <img src="{{"assets/login_page_asset/images/2.png"}}" class="img-responsive" alt="img" />
                    </div>
                    <div class="form-right-inf">

                        <div class="login-form-content">
                            <form wire:submit.prevent="authenticate" class="signin-form">
                                <div class="one-frm">
                                    <label>Email</label>
                                    <input wire:model="email" type="email" placeholder="Type email of your account">
                                </div>
                                <div class="one-frm">
                                    <label>Password</label>
                                    <input wire:model="password" type="password" placeholder="Type password of your account">
                                </div>
                                <label class="check-remaind">
                                    <input wire:model="remember" type="checkbox">
                                    <span class="checkmark"></span>
                                    <p class="remember">Remember Me</p>
                                </label>

                                <button type="submit" class="btn btn-style mt-3">Sign In </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //form -->
        <!-- copyright-->
        <div class="copyright text-center">
            <div class="wrapper">
                <p class="copy-footer-29">© 2020 Working Sign In. All rights reserved | Design by <a
                        href="https://w3layouts.com">W3layouts</a></p>
            </div>
        </div>
        <!-- //copyright-->
    </section>
    <!-- //form section start -->

    </body>

    @livewireScripts
    </html>
</div>
