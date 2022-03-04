@extends('layouts.app')
@section('content')

    <div class="form-container my-5">
        <div class="title_container">
            <h2 class="text-center">Login</h2>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Email"/>
                @error('email')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password"  />
                @error('password')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- <div class="form-group">
                <select class="form-control">
                    <option>Select Account</option>
                    <option>Buyer</option>
                    <option>Seller</option>
                </select>
            </div> --}}

            <input class="button mt-2" type="submit" value="Login" />
            <a href="{{ route('password.request') }}">Forgot Your Password? </a>
        </form>
    </div>
@endsection