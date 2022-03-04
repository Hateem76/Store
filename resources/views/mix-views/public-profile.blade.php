@can('buyer')
    @php
        $check = 'Buyer.layouts.app';
    @endphp    
@endcan

@extends($check)
@section('content')
<link rel="stylesheet" href="{{ asset('css/vendor-profile.css') }}">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<link rel="stylesheet" href="{{ asset('css/productView.css') }}">

 <!----Profile Start-->
 <div class="row d-flex justify-content-center setScroll"
 style="border-bottom: 1px solid lightgray;background: #f8f8f8;">
 <div class="profile-container">
     <div class="prof-img mt-5 text-center">
         <img src="{{ asset('images/bg/c1.jpg') }}" alt="">
     </div>
     <div class="prof-name text-center">
         <p>{{ $vendor->name }}</p>
     </div>
     @can('is-contact',$vendor)
        <div class="prof-buttons text-center">
            <a type="button" href="{{ route('profile.removeFromContacts',$vendor->id) }}" class="btn btn-primary text-white">Remove From Contacts</a>
        </div>
     @endcan
     @cannot('is-contact',$vendor)
        <div class="prof-buttons text-center">
            <a type="button" href="{{ route('profile.addToContacts',$vendor->id) }}" class="btn btn-primary text-white">Add to Contacts</a>
        </div>
     @endcannot
      
     
     <div class="details mt-4 mb-5">
         <span style="font-size: 20px;font-weight: 500;" class="mt-2">Email : </span> {{ $vendor->email }}
         <br>
         <span style="font-size: 20px;font-weight: 500;margin-top: 5px !important;" class="mt-3">Contact :
         </span>
         {{ $vendor->number }}
         <br>
         <span style="font-size: 20px;font-weight: 500;" class="mt-3">Address : </span> {{ $vendor->address }}    </div>
         <br>
         @can('buyer')
            @can('seller-review',$vendor)
                <span style="font-size: 20px;font-weight: 500;margin-top: 5px !important;" class="mt-3">Review :</span>Yes You can!!!
            @endcan
        @endcan
 </div>
</div>

<!---End of Profile-->

<div class="product-container">
 <h1 class="text-center mt-3 mb-4">Mansoor's Products</h1>
 <hr class="mx-auto mb-5" style="width: 30%;background: #00d6ab;">
 <div class="product-content">
     <img src="{{ asset("images/bg/c1.jpg") }}" alt="" />
     <div class="product-info">
         <p class="title">Truck Loader</p>
         <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet cumque possimus
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
     <img src="{{ asset('images/bg/c4.jpg') }}" alt="" />
     <div class="product-info">
         <p class="title">Truck Loader</p>
         <p class="description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet cumque possimus
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
@endsection