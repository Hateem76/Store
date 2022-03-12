@extends('layouts.app')
@section('content')
<script>
    function myFunction() {
    var pass = document.getElementById("password");
    var pass2 = document.getElementById("password_confirmation");
    if (pass.type === "password") {
        pass.type = "text";
        pass2.type = "text";

    } else {
        pass.type = "password";
        pass2.type = "password";
    }
    }
</script>

    <div class="form-container my-5">
        <div class="title_container">
            <h2 class="text-center">Register</h2>
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" autocomplete="off" placeholder="Business Name"value="{{ old('name') }}" />
                @error('name')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"  id="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" />
                @error('email')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>

            
            
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                <input class="form-control @error('number') is-invalid @enderror" type="text" name="number" id="number" autocomplete="off" placeholder="Contact"value="{{ old('number') }}"/>
                @error('number')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror   
            </div>
            <div class="form-group">
                <select class="form-control @error('id_card') is-invalid @enderror" name="id_card" id="id_card">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('id_card')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
               
            <div class="form-group"> <span><i aria-hidden="true" class="fas fa-city"></i></span>
                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" autocomplete="off" placeholder="City"value="{{ old('address') }}"/>
                @error('address')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror 
            </div>

              
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password"  /> 
                @error('password')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-type Password"  />
                @error('password_confirmation')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            <div style="display: inline-block; padding-right: 10px;
            white-space: nowrap;">
                <label><input type="checkbox" style="" id="eye" onclick="myFunction();"> <span>show password</span></label>
            </div>
            
            <div class="form-group">
                <select class="form-control @error('account_type') is-invalid @enderror" name="account_type" id="account_type">
                    <option value="">Select Account</option>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                </select>
                @error('account_type')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            

            <input class="button mt-2" type="submit" value="Register" />
            <p class="text-center mt-1">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            
        </form>
    </div>

   @endsection