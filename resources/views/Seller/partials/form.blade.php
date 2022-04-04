@csrf

    @error('name')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
    <div class="form-group"> <span><i aria-hidden="true" class="fa fa-user"></i></span>
        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" autocomplete="off" placeholder="Full Name"value="{{ old('name') }}@isset($user){{ $user->name }}@endisset"/>
    </div>

    @error('email')
        <span class="invalid-feedback" role="alert">{{ $message }}</span>
    @enderror
    <div class="form-group"> <span><i aria-hidden="true" class="fa fa-envelope"></i></span>
        <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"  id="email" autocomplete="off" placeholder="Email" value="{{ old('email') }}@isset($user){{ $user->email }}@endisset" />
        
    </div>

@isset($create)
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
@endisset
@if (isset($create))
    <input class="button mt-2" type="submit" value="Create" />
@else
    <input class="button mt-2" type="submit" value="Edit" />    
@endif