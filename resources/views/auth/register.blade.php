@extends('layouts.app')
@section('content')

    <div class="form-container my-5">
        <div class="title_container">
            <h2 class="text-center">Register</h2>
        </div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" autocomplete="off" placeholder="Full Name"value="{{ old('name') }}" />
            </div>
            
            @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"  id="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}" />
                
            </div>
            
            @error('id_card')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-id-card"></i></span>
                <input class="form-control @error('id_card') is-invalid @enderror" type="number" name="id_card" id="id_card" autocomplete="off" placeholder="ID Card"value="{{ old('id_card') }}" />
               
            </div>
            @error('number')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror    
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                <input class="form-control @error('number') is-invalid @enderror" type="number" name="number" id="number" autocomplete="off" placeholder="Contact"value="{{ old('number') }}"/>
            </div>
            @error('address')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror    
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-address-card"></i></span>
                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" autocomplete="off" placeholder="Address"value="{{ old('address') }}"/>
            </div>

            @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror  
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password"  /> 
            </div>
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="Re-type Password"  />
                
            </div>
            @error('account_type')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
            <div class="form-group">
                <select class="form-control @error('account_type') is-invalid @enderror" name="account_type" id="account_type">
                    <option value="">Select Account</option>
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                </select>
            </div>

            <input class="button mt-2" type="submit" value="Register" />
            <p class="text-center mt-1">Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            @error('name')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
        </form>
    </div>

   @endsection