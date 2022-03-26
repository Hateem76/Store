<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        

       
        <title>Dashboard</title>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">


    </head>
    <body>
        <input type="checkbox" id="nav-toggle">
        @include('Buyer.layouts.sidebar')


          <!------Main Content-->

        <div class="main-content">
            <header>
            <h3 class="font-weight-bold">
                <label for="nav-toggle">
                <span class="fas fa-bars mr-3 ml-2"></span>
                </label>
                {{ Auth::user()->name }}
            </h3>
            <div class="search-wrapper">
                <!-- <span class="fas fa-search"></span> -->
                <form action="{{ route('extras.searchProducts') }} " method="POST" class="d-flex">
                    @csrf
                    <input name="search" id="search" class="form-control @error('search') is-invalid @enderror" type="search" placeholder="Search..." />
                    <select class="form-control selectbox" name="option" id="option">
                        <option value="product">Product</option>
                        <option value="vendor">Seller</option>
                    </select>
                    <button class="btn ml-2 search-btn-header" type="submit">
                    <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="user-wrapper profile">
                <img class="profile" src="{{ asset('images/bg/c1.jpg') }}" alt="">
                <div class="profile-name">
                <h5>
                    @can('buyer')
                        Buyer Account
                    @endcan
                    @can('seller')
                        Seller Account
                    @endcan
                </h5>
                </div>
            </div>
            </header>

            <main>

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
                <div class="logout-container2">
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
          
                <!-----Search bar for mobile device-->
                <div class="search-container">
                    <form action="{{ route('extras.searchProducts') }} " method="POST" class="form-inline">
                        @csrf
                        <input name="search" id="search" class="mobile-input-search @error('search') is-invalid @enderror" type="search" placeholder="Search..." />
                        <select class="form-control selectbox" name="option" id="option">
                            <option value="product">Product</option>
                            <option value="vendor">Vendor</option>
                        </select>
                        <button class="mobile-search-btn btn" >
                            <li class="fa fa-search"></li>
                        </button>
                    </form>
                </div>
            @yield('content')
    </main>
  </div>

  <!---End of Main Content-->
 
        <script src="{{ asset('js/jquery-min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                $('.navbar-toggler, .overlay').on('click', function () {
                    $('.mobileMenu').toggleClass('open');
                    $('.overlay').toggleClass('openOverlay');
                });
            })
        </script>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />


    </body>
</html>
