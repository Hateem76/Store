<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-search.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!------Main Content-->
    <div class="main-content">
        
        <div class="profile-search-wrapper">
            <div class="profile-search">
                <div class="close-btn">
                    <i onclick="displaySearch()" class="fa-solid close-icon fa-xmark text-white"></i>
                </div>
                <div class="input-box">
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
                function submitForm(){
                    var data = document.getElementById('proId').value;
                    if(data != ""){
                        document.getElementById('id').value = data;
                        document.getElementById('search-form').submit();
                    }
                }
                function myfun() {
                    document.querySelector('.navbar-collapse').classList.remove('show');
                }
        
                function displaySearch(){
                    document.querySelector('.profile-search-wrapper').classList.toggle('show-search');
                    document.querySelector('.close-icon').classList.remove('show-search');
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
                                    <a class="nav-link page-scroll" href="/">Services</a>
                                </li>
                                <li class="nav-item" onclick="myfun()">
                                    <a class="nav-link page-scroll" href="/">Categories</a>
                                </li>
                                <li class="nav-item" onclick="myfun()">
                                    <a class="nav-link page-scroll" href="/">Contact</a>
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


        <main>

            <div class="filter-header">
                <p>results for Category <span style="color: red;"> "{{ $name }}"</span></p>
                {{-- <div class="select-filterbox">
                    <select>
                        <option>Featured</option>
                        <option>Price:High to low</option>
                        <option>Price:Low to high</option>
                        <option>Avg. Customer Review</option>
                    </select>
                </div> --}}
            </div>
            <!------Product Container start-->
            <div class="product-container">
                @foreach ($products as $product)
    <div class="product-content">
        <img src="{{ asset('images/products/'.$product->image_path) }}" alt="" />
        <div class="product-info">
            <p class="title">{{ $product->name }}</p>
            <p class="description">{{ $product->description }}</p>
            <div class="common-class">
                <p class="rating">
                    <i class="fas fa-id-card mr-2"></i>Product Id : pro{{ $product->id }}
                    {{-- <i class="fa fa-star "></i>
                    <i class="fa fa-star "></i>
                    <i class="fa fa-star "></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> --}}
                </p>
                <p class="weight">
                    <i class="fas fa-weight mr-2"></i>Weight : {{ $product->weight }} {{ $product->unit }}
                </p>
            </div>
            <div class="common-class">
                <a href="{{ route('extras.vendorProfile',$product->user->id) }}" class="" style="text-decoration: none;"><p class="product-price text-danger font-weight-bold">
                    {{ $product->user->name }}
                 </p></a>
                <p class="type">
                    <i class="fa fa-file mr-2"></i>Type : {{ $product->category->name }}
                </p>
            </div>
            <div class="common-class">
                <p class="rent">
                    <i class="fas fa-truck-loading mr-2"></i>Rent :
                <ul class="text-dark" style="font-weight: 600;letter-spacing: 1px;">
                    <li>{{ $product->rent_month }} per Month</li>
                    <li>{{ $product->rent_week }} per Week</li>
                    <li>{{ $product->rent_day }} per day </li>
                </ul>
                </p>
            </div>
            <p class="brand">
                <i class="fas fa-briefcase mr-3"></i>Company: {{ $product->brand_name }}
            </p>
            {{-- @can('buyer') --}}
                <a href="{{ route('buyer.requestForRent',[$product->user->id,$product->id]) }}" class="addToCartBtn btn">REQUEST FOR RENT</a>
            {{-- @endcan --}}
        </div>
    </div>
    @endforeach
            </div>
            <!-----Product Container ends-->

        </main>

    </div>

    <!---End of Main Content-->




    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>