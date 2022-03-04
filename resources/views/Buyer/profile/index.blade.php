@extends('Buyer.layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/vendor-profile.css') }}">
<!----Profile Start-->
<div class="row d-flex justify-content-center setScroll"
style="border-bottom: 1px solid lightgray;background: #f8f8f8;">
<div class="profile-container">
    <div class="prof-img mt-5 ml-2">
        <img src="{{ asset('images/bg/c1.jpg') }}" alt="">
    </div>
    <div class="prof-name text-center mr-4">
        <p>{{ Auth::user()->name }}</p>
    </div>
    <div class="prof-buttons">
        <a type="button" href="{{ route('profile.edit') }}" class="btn btn-primary text-white edit-profile">
            <i class="fa fa-edit mr-2"></i> Edit Profile</a>
        <!-- <button class="btn btn-secondary ml-1">Message</button> -->
    </div>
    <div class="details mt-4 mb-5">
        <span style="font-size: 20px;font-weight: 500;" class="mt-2">Email : </span> {{ Auth::user()->email }}
        <br>
        <span style="font-size: 20px;font-weight: 500;margin-top: 5px !important;" class="mt-3">Contact :
        </span>
        {{ Auth::user()->number }}
        <br>
        <span style="font-size: 20px;font-weight: 500;" class="mt-3">Address : </span> {{ Auth::user()->address }}
    </div>
</div>
</div>

@endsection