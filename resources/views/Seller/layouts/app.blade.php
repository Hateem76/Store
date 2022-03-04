<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        

       
        <title>Dashboard</title>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">


    </head>
    <body class="">
      
        <nav class="navbar navbar-expand-lg justify-content-sm-start" style="background-color: #fff;">
            <a style="color: #000;" class="navbar-brand order-1 order-lg-0 ml-2 ml-lg-0 mr-auto text-bold"
                href="{{ route('extras.login') }}">Seller</a>
            <button class="navbar-toggler align-self-start" id="navbar-toggler" type="button">
                <span class="fas fa-bars" style="color: #000 !important;"></span>
            </button>
            <!----Profile button for Mobile device only-->
            <div class="user-icon-mob-container order-1 ml-auto">
                <span class="fa fa-user order-1 ml-auto user-icon-mobile"></span>
            </div>
    
            <div class="collapse navbar-collapse d-flex p-3 p-lg-0 mt-5 mt-lg-0 flex-coulmn flex-lg-row flex-xl-row justify-content-lg-end mobileMenu"
                id="navbarSupportedContent mobileMenu">
                <ul class="navbar-nav align-self-stretch">
                    <li class="nav-item active">
                        <a class="nav-link active" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('extras.login') }}">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            OtherText
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                    <form action="{{ route('extras.searchProducts') }} " method="POST" class="form-inline my-2 my-lg-0">
                        @csrf
                        <input class="form-control mr-sm-2 @error('search') is-invalid @enderror" type="search" placeholder="Search products.."
                            aria-label="Search" id="search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <form action="{{ route('extras.searchVendors') }} " method="POST" class="form-inline my-2 my-lg-0">
                        @csrf
                        <input class="form-control mr-sm-2 @error('search') is-invalid @enderror" type="search" placeholder="Search Vendors.."
                            aria-label="Search" id="search" name="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                    <!----Profile button for Desktop device only-->
                    <li class="nav-item profile">
                        <a class="d-flex justify-content-center">
                            <i class="fas fa-user"></i>
    
                        </a>
                    </li>
    
                </ul>
    
                <div class="logout-container">
                    <ul>
                        <a href="{{ route('profile.show') }}" class="text-dark" style="text-decoration: none;"><li>Profile</li></a>
                        <a href="{{ route('logout') }}" class="text-dark" style="text-decoration: none;" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();  "><li>Logout</li></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                </div>
                <script>
                    document.querySelector('.profile').addEventListener('click', (e) => {
                        document.querySelector('.logout-container').classList.toggle('show');
                    });
    
                    document.querySelector('.user-icon-mob-container').addEventListener('click', () => {
                        document.querySelector('.logout-container2').classList.toggle('show');
                    });
                </script>
    
            </div>
        </nav>
        <div class="logout-container2">
            <ul>
                <li><a href="{{ route('profile.show') }}" class="text-dark" style="text-decoration: none;">Profile</a></li>
                <a href="{{ route('logout') }}" class="text-dark" style="text-decoration: none;" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();  "><li>Logout</li></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search vendors.." class="mobile-input-search" />
            <button class="mobile-search-btn">
                <li class="fa fa-search"></li>
            </button>
        </div>
        <div class="overlay"></div>
    
    
        @yield('content')




        <script src="{{ asset('js/jquery-min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.navbar-toggler, .overlay').on('click', function () {
                    $('.mobileMenu').toggleClass('open');
                    $('.overlay').toggleClass('openOverlay');
                })
            })
        </script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />


    </body>
</html>
