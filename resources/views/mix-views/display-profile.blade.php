<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile-page.css') }}">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" href="{{ asset('css/product-view.css') }}">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery-min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css"
        integrity="sha512-BnbUDfEUfV0Slx6TunuB042k9tuKe3xrD6q4mg5Ed72LTgzDIcLPxg6yI2gcMFRyomt+yJJxE+zJwNmxki6/RA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        
        @media screen and (max-width:1014px) {
            #about img{
                width: 18rem !important;
                height: 15rem !important;
            }
            .product-container .product-content img{
                width: 14rem !important;
                height: 12rem !important;
            }
        }
        @media screen and (max-width:520px) {
            .product-content{
                flex-direction: column;
            }
            .product-container .product-content img{
                width: 100% !important;
                height: 12rem !important;
            }
            .profile-page .gallery img{
                margin-bottom: 0 !important;
            }
            #about img{
                width: 96% !important;
                height: 15rem !important;
            }
            .product-content .product-info{
                justify-content: flex-start;
                align-items: flex-start;
                margin-top: 0;
                padding-left: 0;
            }
            .nav-pills .nav-item{
                flex: 33%;
            }
            .tab-pane table th,td{
                font-size: 11px;
                font-weight: 100;
            }
        }
    </style>
    <script type="text/javascript">
        function editAbout(){
            document.getElementById('aboutUs').removeAttribute('readonly');
            document.getElementById('updateAbout').removeAttribute('hidden');
        }
        function editServices(){
            document.getElementById('services').removeAttribute('readonly');
            document.getElementById('updateServices').removeAttribute('hidden');
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
        function updateServices(){
            var services = document.getElementById('services').value;
            var data = {
                'services' : services,
            };
            $.ajax({
            type: "GET",  
            data: data,
            url: "/profile/updateServices",
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


    <!-- The Modal -->
<div class="modal fade mt-4" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Update Profile Image</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form action="{{ route('profile.updateDp') }}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="modal-body">  
                    <div class="form-group row">
                    <div class="col-12 mx-auto mb-3">
                        <label for="quotation">Choose Image</label>
                        <input type="file" id="image_path" name="image_path" accept=".jpg,.jpeg,.png" class="form-control @error('image_path') is-invalid @enderror">
                        @error('image_path')
                            {{ $message }}
                        @enderror
                    </div>
                    <button type="submit" class="btn text-white form-control"style = "background-color: #184A45FF;">Update</button>  
                </div>
                </div>
            </form>
            <!-- Modal footer -->
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

    <!------Main Content-->

<div class="main-content">
    @include($header)

    <main class="mt-3">
        @include($logoutCode)

                      <!-- Profile Start -->
           
<div class="profile-page">
    
    <div class="page-header header-filter" data-parallax="true"></div>
    <div class="main main-raised">
		<div class="profile-content">
            <div class="container">
                <div class="row">
	                <div class="col-md-6 ml-auto mr-auto">
        	           <div class="profile">
	                        <div class="avatar">
	                            <img src="{{ asset('images/dp/'.Auth::user()->avatar) }}" alt="Circle Image" class="img-raised rounded-circle img-fluid" onclick="$('#myModal').modal('show');" style="cursor:pointer;">
	                        </div>
	                        <div class="name">
	                            <h3 class="title">{{ Auth::user()->name }}</h3>
                                <div class="add-friend mb-3">
                                    <a class="btn btn-info text-white" href="{{ route('profile.edit') }}" style="border-radius: 20px;text-transform: none;">Edit Profile</a>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5 class="pt-2 pr-2">Email : </h5>
                                    <h6> {{ Auth::user()->email }}</h6>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5 class="pt-2 pr-2">Address : </h5>
                                    <h6> {{ Auth::user()->address }} {{ Auth::user()->id_card }}</h6>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5 class="pt-2 pr-2" style="margin-left: -88px;">Contact No : </h5>
                                    <h6> {{ Auth::user()->number }}</h6>
                                </div>

	                        </div>
	                    </div>
    	            </div>
                </div>
                <div class="row setScroll justify-content-center vendor-bio-container py-5 py-lg-0">
                    <div class="col-md-10 vendor-bio col-12 ">
                        <div class="d-flex" style="justify-content: space-between;align-items: center;">
                            <h5 class="text-success">ABOUT : <span class="text-dark" style="font-size: 14px;">The max size is 300 characters</span></h5>
                            <button class="btn btn-sm btn-info mb-3" onclick="editAbout();">Edit about</button>
                        </div>
                        <textarea id="aboutUs" class="form-control text-secondary" rows="5" readonly>{{ Auth::user()->about }}</textarea>
                        {{-- <p class="p-3 p-lg-2 text-secondary" id="aboutUs">
                            {{ Auth::user()->about }}
                        </p> --}}
                        <button id="updateAbout" class="btn btn-success btn-sm mt-2" onclick="updateAbout();" hidden>Done</button>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-6 ml-auto mr-auto">
                        <div class="profile-tabs">
                          <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                    <i class="fas fa-wrench"></i>
                                  Services
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#projects" role="tab" data-toggle="tab">
                                  <i class="material-icons">palette</i>
                                    Projects
                                </a>
                            </li>
                            @can('seller')
                                <li class="nav-item">
                                    <a class="nav-link" href="#products" role="tab" data-toggle="tab">
                                        <i class="fas fa-cart-arrow-down"></i>
                                        Products
                                    </a>
                                </li>
                            @endcan
                            <li class="nav-item">
                                <a class="nav-link" href="#about" role="tab" data-toggle="tab">
                                    <i class="fas fa-briefcase"></i>
                                    About
                                </a>
                            </li>
                          </ul>
                        </div>
    	    	</div>
            </div>
        
          <div class="tab-content tab-space">
            <div class="tab-pane active text-center gallery" id="studio">
                <div class="row justify-content-center align-items-center">             
                    <div class="services col-md-7 mx-auto  pb-5 pt-3 pr-3 rounded" style="text-align: justify;">
                        <div class="d-flex justify-content-between">
                            <div class="">
                                <h4 class="text-success">Services: <span class="text-dark" style="font-size: 14px;">The max size is 300.</span></h4>
                                <hr style="width: 90%;" class="bg-success">
                            </div>
                                <button class="btn btn-sm btn-info mb-3" style="position: absolute;right: 2%;top: 3%;" onclick="editServices();">Edit</button>
                        </div>
                                <textarea id="services" class="form-control text-secondary" rows="5" readonly>{{ Auth::user()->services }}</textarea>
                                <button id="updateServices" class="btn btn-success btn-sm mt-2" onclick="updateServices();" hidden>Done</button>            
                    </div>
  				</div>
  				{{-- <div class="row justify-content-center align-items-center">
                   
                    <div class="services col-md-7 mx-auto  pb-5 pt-3 pr-3 rounded" style="text-align: justify;">
                        <h4 class="text-success">Services</h4>
                        <button class="btn btn-sm btn-info mb-3" onclick="editServices();">Edit services</button>
                        <hr style="width: 12%;" class="bg-success">
                        <textarea id="services" class="form-control text-secondary" rows="5" readonly>{{ Auth::user()->services }}</textarea>
                        <button id="updateServices" class="btn btn-success btn-sm mt-2" onclick="updateServices();" hidden>Done</button>
                    </div>
  				</div> --}}
  			</div>
            <div class="tab-pane text-center gallery" id="projects">
      			<div class="row">
                    <div class="services col-md-7 mx-auto" style="text-align: justify;">
                        <h4 class="text-success text-center">Projects</h4>
                        <hr style="width: 12%;" class="mx-auto bg-success">
                        <div class="row mx-auto py-4">
                            <div class="col-md-12 mx-auto">
                            <table class="table table-bordered border bg-white shadow-sm border rounded">
                                <thead class="bg-info text-white">
                                <tr>
                                @php
                                    $serialNo = 1;
                                @endphp
                                <th>SR. No</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $serialNo++ }}</td>
                                    <td>{{ $project->date_from }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
      			</div>
  			</div>
              @can('seller')
              <div class="tab-pane text-center gallery" id="products">
                <div class="product-container" style="box-shadow: 0 0 0 !important;padding-top: 0;">
                    <h4 class="text-center text-success mt-3 mb-4">Products</h4>
                    <hr class="mx-auto mb-5" style="width: 10%;background: #00d6ab;">
                    @foreach ($products as $product)
                    <div class="product-content">
                        <img style="width: 27rem;height: 18rem;" src="{{ asset('images/products/'.$product->image_path) }}" alt="" />
                        <div class="product-info">
                            <p class="title">{{ $product->name }}</p>
                            <p class="description">{{ $product->description }}</p>
                            <div class="common-class">
                                <p class="rating">
                                    <i class="fa fa-star "></i>
                                    <i class="fa fa-star "></i>
                                    <i class="fa fa-star "></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </p>
                                <p class="weight">
                                    <i class="fas fa-weight mr-2"></i>Weight : {{ $product->weight }} {{ $product->unit }}
                                </p>
                            </div>
                            <div class="common-class">
                                <p class="product-price">
                                    <i class="fas fa-dollar mr-2"></i>Currency : {{ $product->currency }}
                                </p>
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
                                <i class="fas fa-briefcase mr-3"></i>Brand: {{ $product->brand_name }}
                            </p>
                            {{-- <a class="addToCartBtn btn">REQUEST FOR RENT</a> --}}
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
              @endcan
            <div class="tab-pane text-center gallery" id="about">
      			<div class="row">      
                    <div class="services col-md-5 mx-auto  pb-5 pt-3 pr-3 rounded" style="text-align: justify;">
                        <h4 class="text-success">About Us</h4>
                        <hr style="width: 12%;" class="bg-success">
                        {{ Auth::user()->about }}                    
                    </div>
                    <div class="col-md-7">
                        <img src="{{ asset('images/dp/'.Auth::user()->avatar) }}" style="width: 33rem;height: 20rem;border-radius: 10px;" alt="">
                    </div>
      			</div>
      		</div>
          </div>
          </div>

        
            </div>
        </div>
	</div>
    
    </main>
</div>


</body>

</html>