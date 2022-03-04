@can('buyer')
    @php
        $check = 'Buyer.layouts.app';
    @endphp    
@endcan

@extends($check)
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<!---Product heading---->
<div class="container-fluid add-product-container shadow-lg mt-4 mb-4"
style="background-color: white; width:72%; height:auto; border-radius:10px;">
<div class="row mt-2">
    <div class="text-bold mx-auto mt-4 mt-xs-1">
        <h1>
            <i class="fas fa-user mr-3" style="color:#00d6ab;"></i> Edit Profile
        </h1>
        <hr style="background-color: #00d6ab;">
    </div>

</div>
<form action="" method="post">
    <div class="d-flex justify-content-center row mx-auto">
        <div class="edit-prof-img mx-auto my-2">
            <img src="{{ asset('images/bg/c1.jpg') }}" alt="">
        </div>
    </div>
    <div class="form-group justify-content-center row mx-auto">
        <div class="col-sm-5 mt-3">
            <label>Name :</label>
            <input type="text" value="Muhammad Hateem" name="name" required class="form-control">
        </div>
        <div class="col-sm-5 mt-3">
            <label>Email : </label>
            <input value="hateem@gmail.com" type="email" class="form-control">
        </div>

    </div>
    <div class="form-group justify-content-center row">
        <div class="col-sm-10 mt-2 col-11">
            <label for="">Contact :</label>
            <input type="number" placeholder="+19393938854" class="form-control">
        </div>
    </div>

    <div class="form-group justify-content-center row">
        <div class="col-sm-10 mt-2">
            <label for="" class="ml-sm-3">Address :</label>
            <textarea rows="5" placeholder="Northern bypass bossan road multan."
                class="form-control"></textarea>
        </div>
    </div>
    <div class="row mx-auto justify-content-center mt-4">
        <button type="button" class="btn btn-primary btn-lg mt-4 mb-5" style="width: 300px;">Update</button>
    </div>

</form>

</div>

@endsection