<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/landing_page/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing_page/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing_page/second-section.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing_page/categories.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing_page/products.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing_page/test2.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/landing_page/navbar.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Welcome</title>
    <style>
        .carousel-item::before {
            content: "";
            display: block;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #000;
            opacity: .8;
        }
        .fixed-top {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
        }
        @media screen and (max-width:768px) {
            .carousel-item::before{
                opacity: .6;
            }
        }
    </style>
</head>

<body>
    



    <div class="profile-search-wrapper">
        <div class="profile-search">
            <div class="close-btn">
                <i onclick="displaySearch()" class="fa-solid close-icon fa-xmark text-white"></i>
            </div>
            <div class="input-box d-flex">
                <form action="{{ route('extras.searchProfileId') }}" id="search-form" method="POST" hidden>
                    @csrf
                    <input type="text" id="id" name="id">
                </form>
                <input type="text" id="proId" placeholder="Search By Profile Code..">
                <button class="search-btn bg-success text-white py-2" style="font-weight: bold;font-size: 22px;" onclick="submitForm();">
                    <i class="fa fa-search mr-3 search-icon" style="font-size: 20px;"></i>
                    SEARCH
                </button>
            </div>
        </div>
    </div>
    <script>
        function myfun() {
            document.querySelector('.navbar-collapse').classList.remove('show');
        }

        function displaySearch(){
            document.querySelector('.profile-search-wrapper').classList.toggle('show-search');
            document.querySelector('.close-icon').classList.remove('show-search');
        }
        function submitForm(){
            var data = document.getElementById('proId').value;
            if(data != ""){
                document.getElementById('id').value = data;
                document.getElementById('search-form').submit();
            }
        }
    </script>

     <!-- Header Section Start -->
     <header id="slider-area">
        <nav class="navbar py-md-3 py-2 navbar-expand-md shadow-lg fixed-top scrolling-nav bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-weight: 600;" href="index.html"><span></span>
                    Tenders Cascade </a>
                    <li title="Search by Profile Code" class="order-md-1 order-0 search-option mr-md-3 pl-5 pl-md-0 text-white" onclick="myfun();displaySearch();">
                        <a class="nav-link page-scroll order-0">
                            <i class="fa fa-search order-0"></i>
                        </a>
                    </li>
                <button class="navbar-toggler text-white ml-2" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars ml-3 ml-md-0" style="font-size: 22px;"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto w-100 justify-content-end">
                        <li class="nav-item" onclick="myfun()">
                            <a class="nav-link page-scroll" href="/">Home</a>
                        </li>
                        <li class="nav-item" onclick="myfun()">
                            <a class="nav-link page-scroll" href="#services">Services</a>
                        </li>
                        <li class="nav-item" onclick="myfun()">
                            <a class="nav-link page-scroll" href="#categories">Categories</a>
                        </li>
                        <li class="nav-item" onclick="myfun()">
                            <a class="nav-link page-scroll" href="#contact">Contact</a>
                        </li>
                        {{-- <li class="nav-item" onclick="myfun()">
                            <a class="nav-link page-scroll" href="#about">About</a>
                        </li> --}}
                        <li class="nav-item login-item" onclick="myfun()"></li>
                        @if(Route::has('login'))
                            @auth
                                <a href="{{ route('extras.login') }}"class="btn btn-lg login-button">
                                    Dashboard
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            
                        @else
                            <a href="{{ route('login') }}">
                                <button class="btn btn-lg login-button">Login/Register</button>
                            </a>
                            @endauth
                        @endif
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Carousel Section -->
        <div id="carousel-area">
            <div id="carousel-slider" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-slider" data-slide-to="1"></li>
                    <li data-target="#carousel-slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/bg/c1.jpg') }}" alt="" style="width: 100%;">
                        <div class="carousel-caption text-left">
                            <!-- <h3 class="wow fadeInRight" data-wow-delay="0.2s">Handcrafted</h1> -->
                            <h2 class="wow fadeInRight" data-wow-delay="0.4s">Dubai Global Village</h2>
                            <h4 class="wow fadeInRight" data-wow-delay="0.6s">Post a job and hire a pro!
                            </h4>
                            <div class="first-btn">
                                <a href="#" class="btn btn1 btn-lg btn-common btn-effect wow fadeInRight text-center"
                                    data-wow-delay="0.9s">Register Now!</a>
                                <a href="{{ route('register') }}" class="btn btn1 btn-lg btn-border wow fadeInRight"
                                    data-wow-delay="1.2s">Discover!</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/bg/c2.jpg') }}" alt="" style="width: 100%;">
                        <div class="carousel-caption text-center">
                            <h3 class="wow fadeInDown">Browse and buy Projects
                            </h3>
                            <h2 class="wow bounceIn">Let us help you find the right talent</h2>
                            <!-- <h4 class="wow fadeInUp" data-wow-delay="0.9s">Parallax, Video, Product, Premium Addons and More...</h4> -->
                            <a href="{{ route('register') }}" class="btn btn2 btn-lg btn-common btn-effect wow fadeInUp"
                                data-wow-delay="1.2s">Explore!</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/bg/c4.jpg') }}" alt="" style="width: 100%;">
                        <div class="carousel-caption text-center">
                            <h3 class="wow fadeInDown" data-wow-delay="0.3s">Ready For</h3>
                            <h2 class="wow fadeInRight third-h2">Sell your services and Earn
                                prices!
                            </h2>
                            <!-- <h4 class="wow fadeInUp" data-wow-delay="0.6s">App, Business, SaaS and Landing Pages</h4> -->
                            <a href="{{ route('register') }}" class="btn btn3 btn-lg btn-border wow fadeInUp" data-wow-delay="0.9s">Give it a
                                try!</a>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carousel-slider" role="button" data-slide="prev">
                    <span class="carousel-control" aria-hidden="true"><i class="fas fa-angle-left"
                            style="color: black;"></i></span>
                    <span class="sr-only" style="z-index:100;">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-slider" role="button" data-slide="next">
                    <span class="carousel-control" aria-hidden="true"><i class="fas fa-angle-right"
                            style="color: black;"></i></span>
                    <span class="sr-only" style="z-index:999;">Next</span>
                </a>
            </div>
        </div>


    </header>
    <!-- Header Section End -->

    <!-- Call to Action Start -->
    {{-- <section class="call-action section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="cta-trial text-center">
                        <h3>Are You Ready To Get Started?</h3>
                        <p>Equipment you can count on. People you can trust.<br> Cleanliness is a habit nice, without paying heavy price.</p>
                        <a href="#" class="btn btn-lg btn-dark" style="width: 200px;" data-wow-delay="0.9s">Order
                            Now!</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Call to Action End -->

    <!------Categories-->
    <section class="categories" id="categories">
        <div class="section-header mt-4 mb-5 pb-2">
            <h2 class="section-title">Categories</h2>
        </div>
        <div class="row cat-container" onclick="document.getElementById('cat1').click();">
            <div class="card-container">
                <img src="{{ asset('images/categories/'.$cat1->image) }}" alt="">
                <div class="cat-title">
                    <h5>{{ $cat1->name }}</h5>
                    <a href="{{ route('extras.showCatProducts',$cat1->id) }}" hidden id="cat1"></a>
                </div>
            </div>
            <div class="card-container" onclick="document.getElementById('cat2').click();">
                <img src="{{ asset('images/categories/'.$cat2->image) }}" alt="">
                <div class="cat-title">
                    <h5>{{ $cat2->name }}</h5>
                    <a href="{{ route('extras.showCatProducts',$cat2->id) }}" hidden id="cat2"></a>
                </div>
            </div>
            <div class="card-container" onclick="document.getElementById('cat3').click();">
                <img src="{{ asset('images/categories/'.$cat3->image) }}" alt="">
                <div class="cat-title">
                    <h5>{{ $cat3->name }}</h5>
                    <a href="{{ route('extras.showCatProducts',$cat3->id) }}" hidden id="cat3"></a>
                </div>
            </div>
        </div>
        <div class="row mt-4 mb-5 cat-container">
            <div class="card-container" onclick="document.getElementById('cat4').click();">
                <img src="{{ asset('images/categories/'.$cat4->image) }}" alt="">
                <div class="cat-title">
                    <h5>{{ $cat4->name }}</h5>
                    <a href="{{ route('extras.showCatProducts',$cat4->id) }}" hidden id="cat4"></a>
                </div>
            </div>
            <div class="card-container" onclick="document.getElementById('cat5').click();">
                <img src="{{ asset('images/categories/'.$cat5->image) }}" alt="">
                <div class="cat-title">
                    <h5>{{ $cat5->name }}</h5>
                    <a href="{{ route('extras.showCatProducts',$cat5->id) }}" hidden id="cat5"></a>
                </div>
            </div>
            <div class="card-container" onclick="document.getElementById('cat6').click();">
                <img src="{{ asset('images/categories/'.$cat6->image) }}" alt="">
                <div class="cat-title">
                    <h5>{{ $cat6->name }}</h5>
                    <a href="{{ route('extras.showCatProducts',$cat6->id) }}" hidden id="cat6"></a>
                </div>
            </div>
        </div>
    </section>
    <!---End of Categories-->

    <!------Second Section----->

    <section class="secondSection p-4" style="background-color: #f8f8f8;">
        <div class="right-part col-md-6" data-aos="fade-up" data-aos-duration="2000">
            <p class="heading">
                Browse Our Wide Selection Of heavy<br> Equipment Rentals
            </p>
            <div class="icons-name">
                <i class="far fa-star mt-2" style="font-size: 35px;color: #d9534f;"></i>
                <p>Hire the<br>top Talent</p>
                <i class="fas fa-dollar-sign mt-2 ml-5" style="font-size: 35px;color: #d9534f;"></i>
                <p>Sell and<br> Earn</p>
            </div>
            <div class="discript">
                <p>Check out are some ways and tasks that you can win in our faucet! We are always searching for new
                    types.
                </p>
            </div>
            <div class="">
                <a href="{{ route('register') }}" class="btn btn-lg btn-dark" style="width: 230px;">Register</a>
            </div>
        </div>
        <div class="left-part col-md-6" data-aos="zoom-in" data-aos-duration="2000">
            <img src="images/t2.png" alt="">
        </div>
    </section>

    <!------Second Section----->


    <section class="w3l-ecommerce-main pt-5">
      <!-- /products-->
      <div class="ecom-contenthny py-5" id="services">
        <div class="container py-lg-5">
            <h3 class="hny-title mb-2 text-center">Products</h3>
            <p class="text-center">Browse our wide selection of Equipments</p>
            <!-- /row-->
            <div class="ecom-products-grids row mt-lg-5 mt-3">
                <div class="col-lg-3 col-6 product-incfhny mt-4 ">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro1->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro1->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                    <a  type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                        Inquiry Now
                                    </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro1->name }}</a></h3>
                            <span class="text-muted">{{ $pro1->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro1->brand_name }}</p>
                        </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro1->user->address }} {{ $pro1->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro1->user->id,$pro1->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 product-incfhny mt-4">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro2->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro2->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                    <a  type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                        Inquiry Now
                                    </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro2->name }} </a></h3>
                            <span class="text-muted">{{ $pro2->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro2->brand_name }}</p>                                </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro2->user->address }} {{ $pro2->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro2->user->id,$pro2->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6 product-incfhny mt-4">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro3->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro3->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                <a  type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                    Inquiry Now
                                </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro3->name }} </a></h3>
                            <span class="text-muted">{{ $pro3->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro3->brand_name }}</p>                                </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro3->user->address }} {{ $pro3->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro3->user->id,$pro3->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 product-incfhny mt-4">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro4->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro4->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                <a  type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                    Inquiry Now
                                </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro4->name }} </a></h3>
                            <span class="text-muted">{{ $pro4->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro4->brand_name }}</p>                                </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro4->user->address }} {{ $pro4->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro4->user->id,$pro4->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 product-incfhny mt-4">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro5->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro5->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                <a  type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                    Inquiry Now
                                </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro5->name }} </a></h3>
                            <span class="text-muted">{{ $pro5->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro5->brand_name }}</p>                                </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro5->user->address }} {{ $pro5->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro5->user->id,$pro5->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 product-incfhny mt-4">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro6->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro6->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                <a  type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                    Inquiry Now
                                </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro6->name }}</a></h3>
                            <span class="text-muted">{{ $pro6->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro6->brand_name }}</p>                                </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro6->user->address }} {{ $pro6->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro1->user->id,$pro1->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 product-incfhny mt-4">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro7->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro7->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                <a type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                    Inquiry Now
                                </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro7->name }} </a></h3>
                            <span class="text-muted">{{ $pro7->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro7->brand_name }}</p>                                </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro7->user->address }} {{ $pro7->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro7->user->id,$pro7->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 product-incfhny mt-4">
                    <div class="product-grid2 shadow-md transmitv border pb-3">
                        <div class="product-image2">
                            <a href="#">
                                <img class="pic-1 img-fluid" src="{{ asset('images/products/'.$pro8->image_path) }}">
                                <img class="pic-2 img-fluid" src="{{ asset('images/products/'.$pro8->image_path) }}">
                            </a>
                            {{-- <div class="transmitv single-item">
                                <a type="submit" class="transmitv-cart ptransmitv-cart add-to-cart">
                                    Inquiry Now
                                </a>
                            </div> --}}
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">{{ $pro8->name }} </a></h3>
                            <span class="text-muted">{{ $pro8->category->name }}</span>
                        </div>
                        <div class="buisness-name d-flex justify-content-between px-3">
                            <p style="margin: 0;font-weight: 600;margin-top: 4px;">Brand</p>
                            <p  style="font-weight: 500;font-size: 16px;" class="d-flex ">
                                <span><img class="mr-2 mt-1" style="width: 14px;height: 14px;" src="images/scale.png" alt="">
                                </span>{{ $pro8->brand_name }}</p>                                </div>
                        <div class="buisness-name flex-coulmn px-3">
                            <p class="text-secondary mt-1">{{ $pro8->user->address }} {{ $pro8->user->id_card }}</p>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('buyer.requestForRent',[$pro8->user->id,$pro8->id]) }}" class="enquiry-button">Inquiry Now</a>
                        </div>
                    </div>
                </div>


            </div>
            <!-- //row-->
        </div>
    </div>
</section>
<!-- //products-->



    <!-- Call To Action Section Start -->
    {{-- <section id="cta" class="section call-to-action" style="background-color: #000;"
        data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="cta-text">
                        <h5>Stil confused? Give it a try, because customer satisfactions is our first periority.</h5>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12 text-right">
                    <a href="#" class="btn justify-content-center call-action-contact-btn btn-border"
                        style="border-radius: 30px;height: 50px;">Contact
                        US</a>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Call To Action Section Start -->

    <!-- Contact Section Start -->
    <section id="contact" class="section" style="margin-bottom: 40px;margin-top: 20px;">
        <div class="contact-form">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title mt-5">Get In Touch</h2>
                    <span>Contact</span>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-xs-12">
                        <div class="contact-block">
                            <form id="contactForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form_control" id="name" name="name"
                                                placeholder="Your Name" required data-error="Please enter your name">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" placeholder="Your Email" id="email" class="form_control"
                                                name="name" required data-error="Please enter your email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Subject" id="msg_subject"
                                                class="form_control" required data-error="Please enter your subject">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form_control" id="message" placeholder="Your Message"
                                                rows="7" data-error="Write your message" required></textarea>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="submit-button">
                                            <button class="btn btn-lg btn-outline-dark" style="width: 200px;"
                                                id="submit" type="submit">Send
                                                Message</button>
                                            <div id="msgSubmit" class="h3 hidden"></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-xs-12">
                        <div class="contact-deatils">
                            <!-- Content Info -->
                            <div class="contact-info_area">
                                <div class="contact-info">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <h5>Location</h5>
                                    <p>Dubai Global Village Mall</p>
                                </div>
                                <!-- Content Info -->
                                <div class="contact-info">
                                    <i class="fas fa-envelope-square"></i>
                                    <h5>E-mail</h5>
                                    <p>tenderscascade@gmail.com</p>
                                </div>
                                <!-- Content Info -->
                                <div class="contact-info">
                                    <i class="fas fa-phone"></i>
                                    <h5>Phone</h5>
                                    <p>+923070517777</p>
                                </div>
                                <!-- Icon -->
                                <ul class="footer-social">
                                    <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                                    <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></i></a></li>
                                    <li><a class="google-plus" href="#"><i class="fab fa-google-plus-g"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->


    <!-- Footer Section Start -->
    <footer>
        <!-- Footer Area Start -->
        <section class="footer-Content" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <h3 class="text-white">ABOUT US</h3>
                        <div class="textwidget">
                            <p style="color:#eaeaea;">If you think you have the passion,
                                attitude and capability to join us
                                the next big software company
                                s so that we can get the convers.</p>
                        </div>
                        <!-- Icon -->
                        <ul class="footer-social">
                            <li><a class="facebook" href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a class="instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></i></a></li>
                            <li><a class="google-plus" href="#"><i class="fab fa-google-plus-g"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title text-bold text-white">Short Link</h3>
                            <ul class="menu">
                                <li><a id="#services" style="color:#eaeaea;">Service</a></li>
                                <li><a id="#about" style="color:#eaeaea;">About</a></li>
                                <li><a href="#" style="color:#eaeaea;">FAQ</a></li>
                                <li><a id="#contact" style="color:#eaeaea;">Contact</a></li>
                                <li><a href="#" style="color:#eaeaea;">Site Map</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title text-bold text-white">Contact Us</h3>
                            <ul class="contact-footer">
                                <li style="color:#eaeaea;">
                                    <strong>Address :</strong> <span>Dubai, global village mall</span>
                                </li>
                                <li style="color:#eaeaea;">
                                    <strong>Phone :</strong> <span>+92307051000</span>
                                </li>
                                <li>
                                    <strong style="color:#eaeaea;">E-mail :</strong> <span><a href="#"
                                            style="color:#eaeaea;">tenderscascade@gmail.com</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-mb-12">
                        <div class="widget">
                            <h3 class="block-title text-bold text-white ml-3">Facebook</h3>
                            <ul class="instagram-footer ml-3">
                                <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                            src="images/instagram/inst2.png" alt=""></a></li>
                                <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                            src="images/instagram/inst3.png" alt=""></a></li>
                                <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                            src="images/instagram/inst4.png" alt=""></a></li>
                                <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                            src="images/instagram/inst5.png" alt=""></a></li>
                                <li><a href="https://www.facebook.com/AltafCateringCompany" target="_blank"><img
                                            src="images/instagram/inst6.png" alt=""></a></li>
                                <li><a href="#"><img src="images/instagram/" alt=""></a></li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>
        <!-- Footer area End -->

        <!-- Copyright Start  -->
        <div id="copyright" style="background-color: #000;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="site-info">
                            <p class="text-center text-white">&copy; Copyright Tenders Cascade
                                <span class="text-white" id="copyright-year"> </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->

        <script>
            const year = new Date().getFullYear();
            console.log(year);
            var copyrightYear = document.getElementById('copyright-year');
            copyrightYear.innerHTML = " " + year;
        </script>

    </footer>
    <!-- Footer Section End -->



    <script src="{{ asset('js/jquery-min.js') }}"></script>
    {{-- <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.nav.js') }}"></script> --}}
    <script src="{{ asset('js/popper.min.js') }}"></script>
    {{-- <script src="{{ asset('js/menu.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.js') }}"></script>
    <script src="js/scrolling-nav.js"></script>
    <script src="{{ asset('js/wow.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
</body>

</html>