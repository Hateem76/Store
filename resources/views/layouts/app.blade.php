<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

       
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <style>
        .form_container input {
            margin-left: auto;
            margin-right: auto;
            width: 100%;
        }
    </style>





        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <marquee behavior="" height="100" width="200" direction="left">Welcome to my Store.</marquee>
                </div>
            </div>
            <div class="row">
                <div class="col"> 
                    <nav class="navbar navbar-expand-md bg-light navbar-light  fixed-top px-5">
                        <a class="navbar-brand" href="#"id="nav_heading"><span class="cheeky">Cheeky</span>Cheeku</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="collapsibleNavbar">
                          @can('logged-in')
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a class="nav-link" href="/">Home</a>
                            </li>
                          
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                            </li>
                      
                          @can('is-mod')
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Products
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('product.Products.create') }}">Add Product</a>
                              </div>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                              </a>
                              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('category.categories.create') }}">Add Category</a>
                              </div>
                            </li>
                          @endcan
                          </ul>
                          @endcan
                          @if(Route::has('login'))
                            @auth
                            <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();  ">Logout</a>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                              </form>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="">Profile</a>
                            </li>    
                          </ul>
                          @else
                              <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ Route('login') }}">Login</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="{{ Route('register') }}">Register</a>
                                </li>    
                              </ul>
                            @endauth
                          @endif
                        </div>  
                      </nav>
                </div>
            </div>
        </div>
    </head>
    <body class="">
      <div class="container">
        @include('partials.alerts')
      </div>
        @yield('content')


 


  <script>
      const year = new Date().getFullYear();
      console.log(year);
      var copyrightYear = document.getElementById('copyright-year');
      copyrightYear.innerHTML = " " + year;
  </script>

</footer>
<!-- Footer Section End -->

        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/jquery-min.js') }}"></script>
        <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('js/jquery.nav.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />


    </body>
</html>
