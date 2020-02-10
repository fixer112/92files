<!DOCTYPE html>
<html class="no-js" lang="en">

    <head>

        <!--- basic page needs
    ================================================== -->
        <meta charset="utf-8">
        <title>92 Files::: a cloud-based resource app</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- mobile specific metas
    ================================================== -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS
    ================================================== -->
        <link rel="stylesheet" href="{{ asset('home\base.css')}}">
        <link rel="stylesheet" href="{{ asset('home\vendor.css')}}">
        <link rel="stylesheet" href="{{ asset('home\main.css')}}">

        <!-- script
    ================================================== -->
        <script src="{{ asset('home\modernizr.js')}}"></script>
        <script src="{{ asset('home\pace.min.js')}}"></script>

        <!-- favicons
    ================================================== -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <script src="{{ asset('assets\app\scripts\vue.js')}}"></script>

    </head>

    <body id="top">

        <div id="preloader">
            <div id="loader"></div>
        </div>


        <!-- header 
    ================================================== -->
        <header class="s-header">

            <div class="header-logo">
                <a class="site-logo" href="/">
                    <img src="{{ asset('assets\app\images\92file.jpeg')}}" alt="Homepage">
                </a>
            </div>

            <nav class="row header-nav-wrap wide">
                <ul class="header-main-nav">
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    @if(Auth::check())
                    <li><a class="" href="{{url(Auth::user()->routeRole())}}">Dashbord</a></li>

                    @endif
                    @if(Auth::check())
                    {{-- smoothscroll --}}
                    <li><a class="" href="{{url('logout')}}">Log Out</a></li>
                    @else
                    <li><a class="" href="{{url('login')}}">Log In</a></li>
                    @endif
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li><a class="" href="#" title="home">Home</a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li><a class="" href="#" title="features">Report</a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li><a class="" href="#" title="faq">FAQ</a></li>
                    <li></a></li>
                    <li></a></li>
                    <li></a></li>
                    <li><a href="#" title="blog">92F Blog</a></li>
                </ul>

                <ul class="header-social">
                    <li><a href="#0"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                    <li><a href="#0"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#0"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
            </nav>

            <a class="header-menu-toggle" href="#"><span>Menu</span></a>
            <br />
        </header> <!-- end header -->
        <p> </p>
        <p> </p>

        <!-- home
    ================================================== -->
        <section id="home" class="s-home target-section">

            <div class="home-image-part"></div>

            <div class="home-content">






                <div class="about-desc__slide">
                    <!-- process
    ================================================== -->
                    <section id="process" class="s-process">



                        <div class="col-full text-center" data-aos="fade-up">
                            <div class="card-header">

                                <h4 class="my-0 font-weight-normal">Search 92Files</h4>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <p class="card-text" style="font-size: 100%">
                                    select document and verify.
                                </p>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <select class="custom-select" v-model="type" style="font-size: x-large;">
                                            <option value="">Select file</option>
                                            <option value="file">File UC</option>
                                            <option value="company">Company UC</option>
                                            <option value="folder">Folder UC</option>
                                            <option value="health">Username Health Folder</option>
                                        </select>



                                    </div>


                                    </p>





                                    <input type="text" class="form-control" aria-label="Text input with dropdown button"
                                        v-model="b" :placeholder="holder" style="font-size: x-large;">

                                    <a :href="a && b ? a+b : ''" class="btn btn-primary" target="_blank">Search

                                        <span id="3FunctionResult"></span></a>
                                </div>
                            </div>

                        </div>

                        <!-- end process -->
                    </section> <!-- end s-process -->
                    <div class="row home-content__main wide">

                        <div>
                            <h1>
                                See The Unique Resource<br>
                                Web App That Does It All.
                            </h1>

                            <h3>
                                92files app: a cloud-based digital document resource centre for all individuals and
                                organizations.
                            </h3>

                            <div class="home-content__button">
                                <!--<a class="btn-video" href="https://player.vimeo.com/video/14592941?color=00a650&title=0&byline=0&portrait=0" data-lity>-->

                                </a>
                                <a href="#" class=" btn btn--primary btn--large">
                                    Log In
                                </a>
                            </div>

                        </div> <!-- end home-content__main -->

                        <a href="#about" class="home-scroll ">
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
                        ABOUT
                    </h1>
                    <p class="lead">

                        <p>92files is a cloud based resource centre that is acessible to everybody in Nigeria that is
                            being designed to carefully arrange and store documents for individuals in an orderly and
                            secured way.
                        </p>
                        <p>It helps to save document in the advent of theft, fire disaster, loss in transit, natural
                            disaster, etc and also show document authenticity. 92files helps personell involved in
                            administration by reducing the emphasis on paper documents which helps during employment,
                            screening, submission of document by doing background check on files. <p>

                            </p>
                </div>
            </div> <!-- end section-header -->

            <div class="row about-desc" data-aos="fade-up">
                <div class="col-full slick-slider about-desc__slider">

                    <div class="about-desc__slide">
                        <h3 class="item-title">Secure.</h3>

                        <p>

                        </p>
                    </div> <!-- end about-desc__slide -->

                    <div class="about-desc__slide">
                        <h3 class="item-title">User-Friendly.</h3>

                        <p>

                        </p>
                    </div> <!-- end about-desc__slide -->

                    <div class="about-desc__slide">
                        <h3 class="item-title">Powerful.</h3>

                        <p>

                        </p>
                    </div> <!-- end about-desc__slide -->

                </div> <!-- end about-desc -->



        </section> <!-- end s-about -->



        <div class="row process-bottom-image" data-aos="fade-up">
            <!--<img src="images/phone-app-screens-1000.png" 
                 srcset="images/phone-app-screens-600.png 600w, 
                         images/phone-app-screens-1000.png 1000w, 
                         images/phone-app-screens-2000.png 2000w" 
                 sizes="(max-width: 2000px) 100vw, 2000px" 
                 alt="App Screenshots"> -->
        </div>

        </section> <!-- end s-process -->



        </div> <!-- end features -->

        </div> <!-- end section-header -->

        <div class="go-top">
            <a class="" title="Back to Top" href="#top"></a>
        </div>


        <!-- Java Script
    ================================================== -->
        <script src="{{ asset('home\jquery-3.2.1.min.js')}}"></script>
        <script src="{{ asset('home\plugins.js')}}"></script>
        <script src="{{ asset('home\main.js')}}"></script>
        <script>
            new Vue({
            el: "#home",
            data: function() {
            return {
            a:"",
            b:"",
            type:"",
            holder:"",
            };
            },
            methods: {
            link(type){
                this.holder = ''
                switch(type) {
                case 'file':
                this.a = '/file/uc/';
                this.holder = 'Enter file unique code';
                break;
                case 'folder':
                this.a = '/folder/uc/';
                this.holder = 'Enter folder unique code';
                break;
                case 'company':
                this.a = '/company/uc/';
                this.holder = 'Enter company unique code';
                break;
                case 'health':
                this.a = '/health/';
                this.holder = 'Enter username';
                break;
                //default:
                // code block
                }
                
                this.b = "";
                console.log(this.a);
            }
            }
            ,
            watch: {
            type(n){
                this.link(n);
            }
            },
            mounted() {
            }
            });
        </script>

    </body>