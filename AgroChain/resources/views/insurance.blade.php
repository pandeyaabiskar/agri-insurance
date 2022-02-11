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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

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

<div id="home" class="hero-section ">
    <div id="experiences" class="container-fluid cultures-section pb-5 pt-5 mt-5">
        <div class="owl-wrapper">
            <h2 class="pb-2 pt-2">Available <span>Insurance Plans</span></h2>
                <div class="owl-carousel owl-theme mt-4">
    <div class="item p-2 container">
        <a href="#" class="custom-card">
            <div class="card card-width box-shadow ">
                <div class="card-body p-0 text-left">
                    <div class="card-img-size img-fluid overflow-hidden">
                        <div class="w-100 img-card"
                             style="background-image: url('{{asset('img/weather-insurance.jpg')}}')"></div>
                    </div>
                    <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">Weather Index Based Insurance<br><span></span><br><span>Insurer : NRIC Insurance</span>
                    </h4>


                    <a href="#" data-toggle="modal" data-target="#insurancemodal"><button class="btn btn-success btn-card mt-3 ml-3">View Details</button></a>
                </div>
            </div>
        </a>
    </div>
                    <div class="item p-2 container">
                        <a href="#" class="custom-card">
                            <div class="card card-width box-shadow ">
                                <div class="card-body p-0 text-left">
                                    <div class="card-img-size img-fluid overflow-hidden">
                                        <div class="w-100 img-card"
                                             style="background-image: url('{{asset('img/insurance.PNG')}}')"></div>
                                    </div>
                                    <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">Area Yield Based Insurance<br><span></span><br><span>Insurer : NRIC Insurance</span>
                                    </h4>


                                    <button class="btn btn-danger btn-card mt-3 ml-3" disabled>Not Available</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item p-2 container">
                        <a href="#" class="custom-card">
                            <div class="card card-width box-shadow ">
                                <div class="card-body p-0 text-left">
                                    <div class="card-img-size img-fluid overflow-hidden">
                                        <div class="w-100 img-card"
                                             style="background-image: url('{{asset('img/peril-insurance.jpg')}}')"></div>
                                    </div>
                                    <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">Multi Peril Crop Insurance<br><span></span><br><span>Insurer : NRIC Insurance</span>
                                    </h4>


                                    <button class="btn btn-danger btn-card mt-3 ml-3" disabled>Not Available</button>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="item p-2 container">
                        <a href="#" class="custom-card">
                            <div class="card card-width box-shadow ">
                                <div class="card-body p-0 text-left">
                                    <div class="card-img-size img-fluid overflow-hidden">
                                        <div class="w-100 img-card"
                                             style="background-image: url('{{asset('img/hail-insurance.jpg')}}')"></div>
                                    </div>
                                    <h4 class="card-title course-card-heading pt-3 pl-3 mb-0">Hail Crop Insurance<br><span></span><br><span>Insurer : NRIC Insurance</span>
                                    </h4>


                                    <button class="btn btn-danger btn-card mt-3 ml-3" disabled>Not Available</button>
                                </div>
                            </div>
                        </a>
                    </div>


</div>
        </div>
        <div class="modal fade" id="insurancemodal" tabindex="-1" role="dialog" aria-labelledby="insuranceModalCenterTitle"
             aria-hidden="true">

            <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">


                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Weather Index Based Insurance Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <iframe
                                src="{{asset('img/Weather-Index-Policy-2075.pdf')}}"
                                frameBorder="0"
                                scrolling="auto"
                                height="700px"
                                width="100%"
                            ></iframe>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <a href="{{route('insurance.create')}}"><button type="button" class="btn btn-success">Apply Insurance</button></a>
                        </div>
                </div>
            </div>
        </div>
    </div></div>



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
        items: 1,
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
