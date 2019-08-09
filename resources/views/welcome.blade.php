<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>92Files</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('assets\home\css\base.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\home\css\vendor.css')}}">
    <link rel="stylesheet" href="{{ asset('assets\home\css\main.css')}}">

    <!-- script
    ================================================== -->
    <script src="{{ asset('assets\home\js\modernizr.js')}}"></script>
    <script src="{{ asset('assets\home\js\pace.min.js')}}"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{ asset('assets\home\favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets\home\favicon.ico')}}" type="image/x-icon">

</head>

<body id="top">


    <div id="preloader">
        <div id="loader"></div>
    </div>

    <!-- header 
    ================================================== -->
    <header class="s-header">

        <div class="header-logo">
            <a class="site-logo" href="index.html">
                <img src="{{ asset('assets/home/images/logo.jpg')}}" alt="Homepage">
            </a>
        </div>

        <nav class="row header-nav-wrap wide">
            <ul class="header-main-nav">
                <li><a href="{{url('/')}}" title="about">Home</a></li>
                <li><a href="{{url('about')}}" title="about">About Us</a></li>
                @if(Auth::check())
                <li><a href="{{url(Auth::user()->routeRole() . '/' . Auth::id())}}" title="Dashbord">Dashbord</a></li>
                <li><a href="{{url('logout')}}" title="login">Sign Out</a></li>
                @else
                <li><a href="{{url('login')}}" title="login">Sign In</a></li>
                @endif

            </ul>

            <ul class="header-social">
                <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </nav>

        <a class="header-menu-toggle" href="#"><span>Menu</span></a>

    </header> <!-- end header -->


    <!-- home
    ================================================== -->
    <section id="home" class="s-home target-section">

        <div class="home-image-part"></div>

        <div class="home-content">

            <div class="row home-content__main wide">

                <h1>
                    An Amazing Resource<br>
                    App That Does It All.
                </h1>

                <h3 style="color: #eeeeee;">
                    92files app is a cloud-based document resource database app for all individuals and organizations.
                </h3>

                <div class="home-content__button">
                    <!--<a class="btn-video" href="https://player.vimeo.com/video/14592941?color=00a650&title=0&byline=0&portrait=0" data-lity>-->


                    <a href="#" class="smoothscroll btn btn--primary btn--large">
                        Get Started
                    </a>
                </div>

            </div> <!-- end home-content__main -->

            <a href="#about" class="home-scroll smoothscroll">
                <span class="home-scroll__text">Scroll Down</span>
                <span class="home-scroll__icon"></span>
            </a>

        </div> <!-- end home-content -->

    </section> <!-- end s-home -->


    <!-- about
    ================================================== -->
    <section id="about" class="s-about target-section">

        <div class="row section-header narrower align-center" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    The Most Robust Cloud-based Resource App.
                </h1>
                <p class="lead">
                    92Files App is designed to carefully organize and store documents in a detailed technique, while
                    observing a high-level of security for a safer document sharing; document privacy is also asusured.
                </p>
            </div>
        </div> <!-- end section-header -->

        <div class="row about-desc" data-aos="fade-up">
            <div class="col-full slick-slider about-desc__slider">

                <div class="about-desc__slide">
                    <h3 class="item-title">Secure.</h3>

                    <p>
                        Note goes here...
                    </p>
                </div> <!-- end about-desc__slide -->

                <div class="about-desc__slide">
                    <h3 class="item-title">User-Friendly.</h3>

                    <p>
                        Note goes here...
                    </p>
                </div> <!-- end about-desc__slide -->

                <div class="about-desc__slide">
                    <h3 class="item-title">Powerful.</h3>

                    <p>
                        Note goes here...
                    </p>
                </div> <!-- end about-desc__slide -->

            </div> <!-- end about-desc -->



        </div>
    </section> <!-- end s-about -->


    <!-- process
    ================================================== -->
    <section id="process" class="s-process">

        <div class="row">
            <div class="col-full text-center" data-aos="fade-up">
                <h2 class="display-2">How 92Files Works?</h2>
            </div>
        </div>

        <div class="row process block-1-4 block-m-1-2 block-tab-full">
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>Sign Up</h3>
                    <p>
                        Note goes here...
                    </p>
                </div>
            </div>
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>Request</h3>
                    <p>
                        Note goes here...
                    </p>
                </div>
            </div>
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>Copy Code</h3>
                    <p>
                        Note goes here...
                    </p>
                </div>
            </div>
            <div class="col-block item-process" data-aos="fade-up">
                <div class="item-process__text">
                    <h3>se Code</h3>
                    <p>
                        Note goes here...
                    </p>
                </div>
            </div>
        </div> <!-- end process -->

        <div class="row process-bottom-image" data-aos="fade-up">
            {{-- <img src="images/phone-app-screens-1000.png" srcset="images/phone-app-screens-600.png 600w, 
                         images/phone-app-screens-1000.png 1000w, 
                         images/phone-app-screens-2000.png 2000w" sizes="(max-width: 2000px) 100vw, 2000px"
                alt="App Screenshots"> --}}
        </div>

    </section> <!-- end s-process -->


    <!-- features
    ================================================== -->
    <section id="features" class="s-features target-section">

        <div class="row section-header narrower align-center has-bottom-sep" data-aos="fade-up">
            <div class="col-full">
                <h1 class="display-1">
                    Loaded With Cuting Edge Features.
                </h1>
                <p class="lead">
                    Note goes here...
                </p>
            </div>
        </div> <!-- end section-header -->

        <div class="row bit-narrow features block-1-2 block-mob-full">

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-upload"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Cloud Based</h3>
                    <p>Note goes here...
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-chat"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">24/7 Availability</h3>
                    <p>Note goes here...
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-shield"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title">Always Secure</h3>
                    <p>Note goes here...
                    </p>
                </div>
            </div>

            <div class="col-block item-feature" data-aos="fade-up">
                <div class="item-feature__icon">
                    <i class="icon-wallet"></i>
                </div>
                <div class="item-feature__text">
                    <h3 class="item-title"> </h3>
                    <p>Note goes here...
                    </p>
                </div>
            </div>

        </div> <!-- end features -->



        <div class="go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>


        <!-- Java Script
    ================================================== -->
        <script src="assets\home\js\jquery-3.2.1.min.js"></script>
        <script src="assets\home\js\plugins.js"></script>
        <script src="assets\home\js\main.js"></script>

    </section>
</body>

</html>