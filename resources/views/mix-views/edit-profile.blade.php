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

            <div class="form-group">
                <span><i class="fa fa-flag"></i></span>
                <select class="form-control pl-5 @error('id_card') is-invalid @enderror" name="id_card" id="id_card">
                    <option value="">Select Country</option>
                    @foreach ($countries as $country)
                        @if (old('id_card',Auth::user()->id_card)== $country->name)
                            <option value="{{ $country->name }}" selected>{{ $country->name }}</option>
                        @else
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('id_card')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
               
            <div class="form-group"> <span><i aria-hidden="true" class="fas fa-city"></i></span>
                <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" autocomplete="off" placeholder="City"value="{{ old('address',Auth::user()->address) }}"/>
            </div>
            @error('address')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
            @enderror

        
            <input class="button mt-2" type="submit" value="Update" />
            
        </form>
    </div>

   @endsection