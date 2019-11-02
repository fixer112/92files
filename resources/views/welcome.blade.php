<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="">
    <meta name="author" content="">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://getbootstrap.com/docs/4.0/examples/pricing/pricing.css" rel="stylesheet">
    <script src="{{ asset('assets\app\scripts\vue.js')}}"></script>
</head>

<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal">{{env('APP_NAME')}}</h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="{{url('/')}}">Home</a>
            <a class="p-2 text-dark" href="{{url('about')}}">About</a>
            @if(Auth::check())
            <a class="p-2 text-dark" href="{{url(Auth::user()->routeRole())}}" title="Dashbord">Dashbord</a>

            @endif
        </nav>
        @if(Auth::check())
        <a class="btn btn-outline-primary" href="{{url('logout')}}" title="login">Sign Out</a>
        @else
        <a class="btn btn-outline-primary" href="{{url('login')}}" title="login">Sign In</a>
        @endif

    </div>



    <div class="container" id="home">
        <div class="card-deck mb-3 text-center">
            {{-- <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Search File</h4>
                </div>





                <!-- i have three cards below, each one has a button and an input field -->


                <div class="card-body d-flex flex-column">
                    <!-- <h5 class="card-title" style="font-size: 200%">Longest Word</h5> -->
                    <p class="card-text" style="font-size: 100%">a Function to find and display the longest word in a
                        phrase, namely the first longest word in case multiple equal size words are present </p>

                    <input type="text" name="1Input" class="mt-auto" id="cell1Input">
                    <input type="submit" class="btn btn-primary" name="1Button" value="Click Me!" id="cell1Button" />
                    <br>
                    <span id="1FunctionResult"></span>
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Search Folder</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <!-- <h5 class="card-title" style="font-size: 200%">Reverse Text</h5> -->
                    <p class="card-text" style="font-size: 100%">a Function to reverese letters in each word </p>

                    <input type="text" name="2Input" class="mt-auto" id="cell2Input">
                    <input type="button" class="btn btn-primary" name="2Button" value="Click me!" id="cell2Button">
                    <br>
                    <span id="2FunctionResult"></span>
                </div>
            </div>
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Search Company</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <!-- <h5 class="card-title"  style="font-size: 200%">Capitalize</h5> -->
                    <p class="card-text" style="font-size: 100%">a Function to split words and capitalize all initial
                        letters in each word</p>

                    <input type="text" name="3Input" class="mt-auto" id="cell3Input">
                    <input type="button" class="btn btn-primary" name="3Button" value="Click me!" id="cell3Button">
                    <br>
                    <span id="3FunctionResult"></span>
                </div>
            </div> --}}
            <div class="card mb-4 box-shadow">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Search {{env('APP_NAME')}}</h4>
                </div>
                <div class="card-body d-flex flex-column">
                    <p class="card-text" style="font-size: 100%">
                        Select what to search, and input the search query.
                    </p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <select class="custom-select" v-model="type">
                                <option value="">Select</option>
                                <option value="file">File UC</option>
                                <option value="company">Company UC</option>
                                <option value="folder">Folder UC</option>
                                <option value="health">Username Health Folder</option>
                            </select>
                            {{-- <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Select</button>
                            <div class="dropdown-menu">
                                <span class="dropdown-item" @click="link('/file/uc/')">File</span>
                                <span class="dropdown-item" @click="link('/company/uc/')">Company</span>
                                <span class="dropdown-item" @click="link('/folder/uc/')">Folder</span>
                                <span class="dropdown-item" @click="link('/health/')">Health Folder</span>
                            </div> --}}
                            {{-- <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a> --}}
                        </div>
                        <input type="text" class="form-control" aria-label="Text input with dropdown button" v-model="b"
                            :placeholder="holder">
                        <a :href="a && b ? a+b : ''" class="btn btn-primary" target="_blank">Search</a>
                    </div>
                    <br>
                    <span id="3FunctionResult"></span>
                </div>
            </div>
        </div>



        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <img class="mb-2" src="{{ asset('assets\app\images\logo.png')}}" alt="" width="24" height="24">
                    <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
                </div>
                {{-- <div class="col-6 col-md">
                    <h5>Features</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Cool stuff</a></li>
                        <li><a class="text-muted" href="#">Random feature</a></li>
                        <li><a class="text-muted" href="#">Team feature</a></li>
                        <li><a class="text-muted" href="#">Stuff for developers</a></li>
                        <li><a class="text-muted" href="#">Another one</a></li>
                        <li><a class="text-muted" href="#">Last time</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Resources</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Resource</a></li>
                        <li><a class="text-muted" href="#">Resource name</a></li>
                        <li><a class="text-muted" href="#">Another resource</a></li>
                        <li><a class="text-muted" href="#">Final resource</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>About</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="#">Team</a></li>
                        <li><a class="text-muted" href="#">Locations</a></li>
                        <li><a class="text-muted" href="#">Privacy</a></li>
                        <li><a class="text-muted" href="#">Terms</a></li>
                    </ul>
                </div> --}}
            </div>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
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

</html>