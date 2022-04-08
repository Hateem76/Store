<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/navbar.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
         .fixed-top {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
        }
    </style>

</head>

<body>

    <script>
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
        <nav class="navbar py-md-3 py-2 navbar-expand-md shadow-lg fixed-top scrolling-nav bg-dark" style="box-shadow: 0 0.5rem 2rem rgba(0,0,0,.175)!important;">
            <div class="container-fluid">
                <a class="navbar-brand" style="font-weight: 600;" href="index.html"><span></span>
                    Tenders Cascade </a>
                      
                <button class="navbar-toggler text-white ml-2" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars ml-3 ml-md-0" style="font-size: 22px;"></i>
                </button>
             
                
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-md-5 w-100 justify-content-end" >
                    
                        <li class="nav-item" onclick="myfun()">
                            <a class="nav-link page-scroll" href="/"><i class="fa fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item" onclick="myfun()">
                            <a class="nav-link page-scroll" href="{{ route('register') }}"><i class="fa fa-user"></i> Sign Up</a>
                        </li>
                     
                    </ul>
                </div>
            </div>
        </nav>

    <div class="form-container">
        <div class="title_container">
            <h2 class="text-center">Login</h2>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Email"/>
                @error('email')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password"  />
                @error('password')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            <div class="show-password form-group d-flex justify-content-start align-items-start">
                <input type="checkbox" class="mt-1"  style="width: 26px;height: 17px;" id="eye" onclick="myFunction();">
                <label class="pl-1">Show Password</label>
            </div>
            <input class="button mt-2" type="submit" value="Login" />
            <a href="{{ route('register') }}">New user? register here </a>
        </form>
    </div>

    

   

    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>