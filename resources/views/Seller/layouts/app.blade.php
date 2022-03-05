<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard</title>
        <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar2.css') }}">
        <link rel="stylesheet" href="{{ asset('css/card.css') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script>
            $(document).ready(function () {
                $('.navbar-toggler, .overlay').on('click', function () {
                    $('.mobileMenu').toggleClass('open');
                    $('.overlay').toggleClass('openOverlay');
                });
            })
        </script>

    </head>
    <body>
        @include('partials.alerts') 
        @include('Seller.layouts.sidebar2')

          <!------Main Content-->

        <div class="main-content">
            @include('Seller.layouts.header')

            <main>

                @include('Seller.layouts.logout-code')
                @yield('content')
                
            </main>
        </div>

  <!---End of Main Content-->
 
        <script src="{{ asset('js/jquery-min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    </body>
</html>
