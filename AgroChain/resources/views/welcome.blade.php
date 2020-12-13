<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AgroChain</title>

    <!-- Scripts -->
{{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

<!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/owl.carousel.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/universal-parallax.min.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
<body>
<div id="name"></div>

<nav class="navbar navbar-expand-lg bg-light navbar-custom position-absolute w-100" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header ml-2">
            <a class="navbar-brand navbar-brand-custom" href="#">
                <img class="navbar-brand-size img-fluid" src="{{asset('img/logo-a.png')}}"></a>
        </div>

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#CollapsibleNavbar">
<span class="navbar-toggler-icon"><i class="fas fa-bars"></i>
</span>
        </button>

        <div class="collapse navbar-collapse" id="CollapsibleNavbar">
            <ul class="navbar-nav nav-pills ml-auto">
                <li class="nav-item mr-3">
                    <a href="#about" class="nav-link nav-text scroll">About</a>
                </li>
                <li class="nav-item mr-3">
                    <a href="#" class="nav-link nav-text scroll" data-toggle="modal" data-target="#trackingModal">Track</a>
                </li>
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item mr-3">
                            <a class="nav-link nav-text scroll" href="{{ route('home') }}">Home</a>
                        </li>
                    @else
                        <li class="nav-item mr-3">
                            <a class="nav-link nav-text scroll" href="{{ url('/login') }}">Login</a>
                        </li>
                        <li class="nav-item mr-3">
                            <a class="nav-link nav-text scroll" href="{{ url('/register') }}">Register</a>
                        </li>
                    @endauth
                @endif


            </ul>
        </div>

    </div>
</nav>
@if(Session::has('message'))
    <div class="alert alert-{{Session::get('class')}} alert-dismissible fade show position-absolute w-100 ml-auto" role="alert" style="top:15%; z-index:10000000;">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="modal fade" id="trackingModal" tabindex="-1" role="dialog" aria-labelledby="trackingModalCenterTitle"
     aria-hidden="true">

    <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
    <div class="modal-dialog modal-dialog-centered" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Enter Token Number</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{route('crop.track')}}">
            <div class="modal-body">
                    @csrf
                    <div class="form-group row">
                        <label for="token" class="col-md-3 col-form-label">Token ID</label>
                        <div class="col-md-9">
                            <input id="token" type="text" class="form-control" name="token">
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <input  class="btn btn-success" type="submit" value="Track">
            </div>
            </form>
        </div>
    </div>
</div>

<div id="home" class="hero-section">
    <div class="parallax d-grid" data-parallax-image="{{asset('img/hero-veg.jpg')}}" style="top:0;">
        <div class="overlay overlay-main "></div>

    </div>

</div>
<div class="heading-main m-auto position-absolute">
    <h1>AGROCHAIN</h1>
    <h5>Agricultural Supply Chain</h5>
    <h6 class="text-white text-center">Buying food directly from farmers is the most powerful everyday act available to anyone to create a positive social and environmental impact.<br>Track good agricultural habits & practices from farm to finger.</h6>
</div>

<div class="container p-0" id="about">
    <section class="home-about">
        <div class="home-about-textbox">
            <h1>Who We Are</h1>
            <p>We believe in <br><strong>TRANSPARENCY</strong></p>
            <p><strong>Organicness</strong> is what defines us.</p>
        </div>
    </section>
</div>
<div class="experiences-section p-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="content-wrapper-left text-left">
                    <h3 class="pb-3">Our Promises</h3>
                    <p class="text-white"><i class="fas fa-check"></i>
                        &nbsp;&nbsp;Track your vegetables and fruits
                    </p>
                    <p class="text-white"><i class="fas fa-check"></i>
                        &nbsp;&nbsp;All products verified
                    </p>
                    <p class="text-white"><i class="fas fa-check"></i>
                        &nbsp;&nbsp;Organicness guaranteed
                    </p>


                    <div class="m-auto w-100 pb-3 pt-3">
                        <a href="#">
                            <button class="btn btn-success btn-blue inquire-button position-relative"><i
                                        class="far fa-comments"></i>
                                Inquire Now
                            </button>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="content-wrapper-right text-left">
                    <div class="pb-2">
                        <h3 class=" d-inline-block">Track your vegetables and fruits&nbsp;</h3><span
                                class=" d-inline-block"
                                style="font-size: 1.5rem;">From farm to hand</span>
                    </div>
                    <img class="w-75 rounded" src="{{asset('img/farmer.jpg')}}">
                </div>
            </div>
        </div>
    </div>
</div>

<div id="experiences" class="container-fluid cultures-section pb-5 pt-5">
    <div class="owl-wrapper">
        <h2 class="pb-2 pt-2">Popular <span>Crops</span></h2>
        <div class="owl-carousel owl-theme mt-4">
            <div class="item p-2 container">
                <a href="#experiences" class="custom-card">
                    <div class="card card-width box-shadow ">
                        <div class="card-body p-0 text-left">
                            <div class="card-img-size img-fluid overflow-hidden">
                                <div class="w-100 img-card"
                                     style="background-image: url('{{asset('img/Cards/onion.jpg')}}')"></div>
                            </div>
                            <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">Onions<br><span>Harvested 2 days ago</span>
                            </h4>

                            <div class="owl-text overflow-hidden">
                                <p class="card-text course-card-text p-3">Onions from India's biggest onion farm. </p>
                            </div>
                            <button class="btn btn-success btn-card mt-3 ml-3">Learn More</button>
                        </div>
                    </div>
                </a>
            </div>
            <div class="item p-2 container">
                <a href="#experiences" class="custom-card">
                    <div class="card card-width box-shadow">
                        <div class="card-body p-0 text-left">
                            <div class="card-img-size img-fluid overflow-hidden">
                                <div class="w-100 img-card"
                                     style="background-image: url('{{asset('img/Cards/apple.jpg')}}')"></div>
                            </div>
                            <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">
                                Apples<br><span>Planted</span></h4>

                            <div class="owl-text overflow-hidden">
                                <p class="card-text course-card-text p-3">Juicy Apples from Mustang.</p>
                            </div>
                            <button class="btn btn-success btn-card mt-3 ml-3">Learn More</button>

                        </div>
                    </div>
                </a>
            </div>
            <div class="item p-2 container">
                <a href="#experiences" class="custom-card">
                    <div class="card card-width box-shadow">
                        <div class="card-body p-0 text-left">
                            <div class="card-img-size img-fluid overflow-hidden">
                                <div class="w-100 img-card"
                                     style="background-image: url('{{asset('img/Cards/brocoli.jpg')}}')"></div>
                            </div>
                            <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">
                                Broccoli<br><span>Planted</span></h4>

                            <div class="owl-text overflow-hidden">
                                <p class="card-text course-card-text p-3">Fresh Broccoli from Nuwakot.</p>
                            </div>
                            <button class="btn btn-success btn-card mt-3 ml-3">Learn More</button>

                        </div>
                    </div>
                </a>
            </div>
            <div class="item p-2 container">
                <a href="#experiences" class="custom-card">
                    <div class="card card-width box-shadow">
                        <div class="card-body p-0 text-left">
                            <div class="card-img-size img-fluid overflow-hidden">
                                <div class="w-100 img-card"
                                     style="background-image: url('{{asset('img/Cards/kiwi.jpg')}}')"></div>
                            </div>
                            <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">Kiwi<br><span>Shipped</span>
                            </h4>

                            <div class="owl-text overflow-hidden">
                                <p class="card-text course-card-text p-3">Organic Kiwis from Palpa.</p>
                            </div>
                            <button class="btn btn-success btn-card mt-3 ml-3">Learn More</button>

                        </div>
                    </div>
                </a>
            </div>
            <div class="item p-2 container">
                <a href="#experiences" class="custom-card">
                    <div class="card card-width box-shadow">
                        <div class="card-body p-0 text-left">
                            <div class="card-img-size img-fluid overflow-hidden">
                                <div class="w-100 img-card"
                                     style="background-image: url('{{asset('img/Cards/pom.jfif')}}')"></div>
                            </div>
                            <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">
                                Pomegranate<br><span>Harvested 1 day ago</span></h4>

                            <div class="owl-text overflow-hidden">
                                <p class="card-text course-card-text p-3">Fresh Pomegranates from Pokhara.</p>
                            </div>
                            <button class="btn btn-success btn-card mt-3 ml-3">Learn More</button>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<div id="nature" class="nature-section">
    <div class="parallax d-grid" data-parallax-image="{{asset('img/fruits.jpg')}}">
        <div class="overlay overlay-main "></div>
    </div>
    <div class="heading-nature m-auto position-absolute">
        <h5>A Step Towards Healthier Life<br></h5>
    </div>
</div>

<div id="myBtn" class="top m-auto text-right" style="position: sticky;" onclick="topFunction()">
    <a href="#home" class="scroll"><i class="fas fa-arrow-up"></i></a>
</div>
<footer class="footer bg-dark custom-footer">
    <p class="text-white text-center m-auto">Copyright © Aabiskar, 2019</p>

</footer>
<script src="{{ asset('js/app.js') }}"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="{{ asset('js/truffle-contract.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('js/contract.js') }}"></script>
{{--<script src="{{ asset('js/bootstrap.min.js') }}"></script>--}}
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/universal-parallax.min.js') }}"></script>
<script type="text/javascript">
    new universalParallax().init({
        speed: 3.0
    });
</script>
<script type="text/javascript">
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplaySpeed: 1000,
        nav: true,
        items: 4,
        dots: false,
        responsive: {
            0: {
                items: 1.5
            },
            600: {
                items: 3.5
            },
            1100: {
                items: 4
            }
        }
    });
</script>
</body>
</html>
