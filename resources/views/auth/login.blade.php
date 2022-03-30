@extends('layouts.app')
@section('content')
<script>
    function myFunction() {
    var pass = document.getElementById("password");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
    }
</script>

    <div class="form-container my-5">
        <div class="title_container">
            <h2 class="text-center">Login</h2>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" type="email" placeholder="Email"/>
                @error('email')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group"> <span><i aria-hidden="true" class="fa fa-lock"></i></span>
                <input class="form-control @error('password') is-invalid @enderror" id="password" name="password" type="password" placeholder="Password"  />
                @error('password')
                    <small class="invalid-feedback" role="alert">{{ $message }}</small>
                @enderror
            </div>
            <div class="show-password form-group d-flex justify-content-start align-items-start">
                <input type="checkbox" class="mt-1"  style="width: 26px;height: 17px;" id="eye" onclick="myFunction();">
                <label class="pl-1">Show Password</label>
            </div>
            <input class="button mt-2" type="submit" value="Login" />
            <a href="{{ route('password.request') }}">Forgot Your Password? </a>
        </form>
    </div>
@endsection