@can('buyer')
    @php
        $check = 'Buyer.layouts.app';
    @endphp    
@endcan

@extends($check)
@section('content')
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<link rel="stylesheet" href="{{ asset('css/productView.css') }}">



<div class="filter-header">
    <p>results for <span style="color: red;"> "{{ $name }}"</span></p>
    {{-- <div class="select-filterbox">
        <select>
            <option>Featured</option>
            <option>Price:High to low</option>
            <option>Price:Low to high</option>
            <option>Avg. Customer Review</option>
        </select>
    </div> --}}
</div>

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
            @can('buyer')
                <a href="{{ route('buyer.requestForRent',[$product->user->id,$product->id]) }}" class="addToCartBtn btn">REQUEST FOR RENT</a>
            @endcan
        </div>
    </div>
    @endforeach
    {{-- <div class="d-flex justify-content-center">
        {{ $products->links() }}
    </div> --}}
</div>
@endsection