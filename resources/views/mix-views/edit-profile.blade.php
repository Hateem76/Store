@extends('layouts.app')
@section('content')

    <div class="form-container my-5">
        <div class="title_container">
            <h2 class="text-center">Edit Profile</h2>
        </div>
        <form action="{{ route('profile.updateProfile') }}" method="POST">
            @csrf
            
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" autocomplete="off" placeholder="Business Name"value="{{ old('name',Auth::user()->name) }}" />
                @error('name')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            
            @error('email')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"  id="email" autocomplete="off" placeholder="Email" value="{{ old('email',Auth::user()->email) }}" />
            </div>
            
            
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-phone"></i></span>
                <input class="form-control @error('number') is-invalid @enderror" type="Number" name="number" id="number" autocomplete="off" placeholder="Contact"value="{{ old('number',Auth::user()->number) }}"/>
                @error('number')
                <small class="invalid-feedback" role="alert">{{ $message }}</small>
        @enderror  
            </div>

            @error('id_card')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
            <div class="form-group"> <span><i aria-hidden="true" class="fas fa-flag"></i></span>
                <input class="form-control @error('id_card') is-invalid @enderror" type="text" name="id_card" id="id_card" autocomplete="off" placeholder="Country"value="{{ old('id_card',Auth::user()->id_card) }}" />
            </div>
               
            @error('address')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror
            <div class="form-group"> <span><i aria-hidden="true" class="fas fa-city"></i></span>
                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" autocomplete="off" placeholder="City"value="{{ old('address',Auth::user()->address) }}"/>
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

            <input class="button mt-2" type="submit" value="Update" />
            
        </form>
    </div>

   @endsection