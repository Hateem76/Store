<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product-view.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript">
        function editAbout(){
            document.getElementById('aboutUs').removeAttribute('readonly');
            document.getElementById('updateAbout').removeAttribute('hidden');
        }
        function updateAbout(){
            var about = document.getElementById('aboutUs').value;
            var data = {
                'aboutUs' : about,
            };
            $.ajax({
            type: "GET",  
            data: data,
            url: "/profile/updateAbout",
            success: function (response){
                window.location.reload();
            }
            });
        }
    </script>
</head>

<body>
    @can('buyer')
        @php
            $sidebar = 'Buyer.layouts.sidebar2';
            $header = 'Buyer.layouts.header';
            $logoutCode = 'Buyer.layouts.logout-code';
        @endphp    
    @endcan

    @include($sidebar)

    <!------Main Content-->

    <div class="main-content">
        @include($header)

        <main class="mt-3">
            @include($logoutCode)

            <!----Profile Start-->
            <div class="row profile-wrapper setScroll"
                style="border-bottom: 1px solid lightgray;background: #fff;">
                <div class="profile-container">
                    <div class="left-section">
                    <div class="prof-img">
                        <img src="{{ asset('images/bg/c1.jpg') }}" alt="">
                    </div>
                    <div class="prof-name">
                        <p>{{ Auth::user()->name }}</p>
                    </div>
                    <div class="prof-buttons">
                        <button class="btn btn-primary" style="background: #184A45FF;">Edit Profile</button>
                    </div>
                </div>
                <div class="">
                    <div class="details">
                        <li>
                        <span class="mt-2">Email : </span> {{ Auth::user()->email }}
                    </li>
                        <br>
                        <li>
                        <span style="margin-top: 10px !important;" class="mt-5">Contact
                            :
                        </span>
                        +92314758980
                    </li>
                        <br>
                        <li>
                        <span  class="mt-3">City : </span>{{ Auth::user()->id_card }}
                    </li>
                    <li>
                        <span  class="mt-3">Country : </span>{{ Auth::user()->address }}
                    </li>
                    </div>
                </div>
                </div>
                <hr>
                <div class="container" style="margin-top: -10px;">
                <div class="row setScroll justify-content-center vendor-bio-container">
                    <div class="col-md-10 vendor-bio col-12">
                        <div class="d-flex" style="justify-content: space-between; align-items:center;">
                            <h5 class="text-primary">ABOUT :</h5>
                            <button class="btn btn-info btn-sm mb-3" onclick="editAbout();">Edit About</button>
                        </div>
                        <textarea id="aboutUs" class="p-2 form-control" rows="6" readonly>{{ Auth::user()->about }}</textarea>
                        <button id="updateAbout" class="btn btn-success btn-sm mt-2" onclick="updateAbout();" hidden>Done</button>
                    </div>
                </div>
            </div>
            </div>

            <!---End of Profile-->
{{-- 
            <div class="product-container">
                <h1 class="text-center mt-3 mb-4">Mansoor's Products</h1>
                <hr class="mx-auto mb-5" style="width: 30%;background: #00d6ab;">
                <div class="product-content">
                    <img src="img/c1.jpg" alt="" />
                    <div class="product-info">
                        <p class="title">Truck Loader</p>
                        <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet cumque
                            possimus
                            earum veniam ipsam.</p>
                        <div class="common-class">
                            <p class="rating">
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </p>
                            <p class="weight">
                                <i class="fas fa-weight mr-2"></i>Weight : 10 kg
                            </p>
                        </div>
                        <div class="common-class">
                            <p class="product-price">
                                <i class="fas fa-dollar mr-2"></i>Price : $2787
                            </p>
                            <p class="type">
                                <i class="fa fa-file mr-2"></i>Type : Loader
                            </p>
                        </div>
                        <div class="common-class">
                            <p class="rent">
                                <i class="fas fa-truck-loading mr-2"></i>Rent :
                            <ul class="text-dark" style="font-weight: 600;letter-spacing: 1px;">
                                <li>$100 per Month</li>
                                <li>$50 per Week</li>
                                <li>$10 per day </li>
                            </ul>
                            </p>
                        </div>
                        <p class="brand">
                            <i class="fas fa-briefcase mr-3"></i>Brand: Brand name
                        </p>
                        <a class="addToCartBtn btn">REQUEST FOR RENT</a>
                    </div>
                </div>
                <div class="product-content">
                    <img src="img/c2.jpg" alt="" />
                    <div class="product-info">
                        <p class="title">Truck Loader</p>
                        <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet cumque
                            possimus
                            earum veniam ipsam.</p>
                        <div class="common-class">
                            <p class="rating">
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star "></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </p>
                            <p class="weight">
                                <i class="fas fa-weight mr-2"></i>Weight : 10 kg
                            </p>
                        </div>
                        <div class="common-class">
                            <p class="product-price">
                                <i class="fas fa-dollar mr-2"></i>Price : $2787
                            </p>
                            <p class="type">
                                <i class="fa fa-file mr-2"></i>Type : Loader
                            </p>
                        </div>
                        <div class="common-class">
                            <p class="rent">
                                <i class="fas fa-truck-loading mr-2"></i>Rent :
                            <ul class="text-dark" style="font-weight: 600;letter-spacing: 1px;">
                                <li>$100 per Month</li>
                                <li>$50 per Week</li>
                                <li>$10 per day </li>
                            </ul>
                            </p>
                        </div>
                        <p class="brand">
                            <i class="fas fa-briefcase mr-3"></i>Brand: Brand name
                        </p>
                        <a class="addToCartBtn btn">REQUEST FOR RENT</a>
                    </div>
                </div>

            </div>

        </main>

    </div> --}}

    <!---End of Main Content-->



</body>

</html>