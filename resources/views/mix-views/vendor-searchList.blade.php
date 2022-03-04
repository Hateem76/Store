@can('buyer')
    @php
        $check = 'Buyer.layouts.app';
    @endphp    
@endcan

@extends($check)
@section('content')
<link rel="stylesheet" href="{{ asset('css/vendor-search.css') }}">
<div class="container-fluid my-5" style="display: flex;flex-direction: column;">
    <div class="row search-result mb-3 p-2" style="background: #f8f8f8;">
        <h6 class="ml-5">Search results for <span style="color: red;">"Hateem"</span></h6>
    </div>
    @foreach ($vendors as $vendor)
        <div class="vendor-container">
            <div class="prof-img">
                <img src="{{ asset('images/users/'.$vendor->avatar) }}" alt="profile image">
                <div class="name-container">
                    <a href="{{ route('extras.vendorProfile',$vendor->id) }}">
                        <h3 class="mt-1">{{ $vendor->name }}</h3>
                    </a>
                    <p>{{ $vendor->address }}</p>
                </div>
            </div>
        </div>
    @endforeach

</div>

@endsection