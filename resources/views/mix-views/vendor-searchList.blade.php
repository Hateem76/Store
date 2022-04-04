@can('buyer')
    @php
        $check = 'Buyer.layouts.app';
    @endphp    
@endcan

@extends($check)
@section('content')
<link rel="stylesheet" href="{{ asset('css/vendor-search.css') }}">
<link rel="stylesheet" href="{{ asset('css/vendor-profile.css') }}">
 <!-----Search List Start-->

 <div class="container-fluid vendor-wrapper mb-5 mt-md-5 mt-2 "
    style="display: flex;flex-direction: column;">
        <div class="row search-result p-2 mb-0" style="background: #fff;border-bottom: 1px solid lightgray;">
            <h6 class="ml-5 pt-4 pb-1">Search results for <span style="color: red;">"{{ $name }}"</span></h6>
        </div>
        @foreach ($vendors as $vendor)
            <div class="vendor-container pt-1">
                <div class="prof-img">
                    <img src="{{ asset('images/dp/'.$vendor->avatar) }}" alt="">
                    <div class="name-container pt-1">
                        <a href="{{ route('extras.vendorProfile',$vendor->id) }}">
                            <h5 class="mt-1">{{ $vendor->name }}</h5>
                        </a>
                        <p>{{ $vendor->email }}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

@endsection