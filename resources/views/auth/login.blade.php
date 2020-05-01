@extends('layouts.login')

@section('login-content')

<div class="container login-container">
    <div class="row signin-container">
        <div class="col-md-8 logo-form">
            <div class="logo">
                <img src="{{url('/img/marines.png')}}" alt="marines">
            </div>
            <div class="brand">
                <h3>Marines Web-Based Examination System</h3>
            </div>
        </div>
        <div class="col-md-4 login-form">
            <h3>Login</h3>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address" />
                    
                    
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror 
                </div>
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password" />
                    
                    
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btnsubmit">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="form-group">
                    {{-- <div class="row register_container">
                        <a class="btn btn-link register" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    </div> --}}
                    <div class="row">
                        <a class="btn btn-link forgtpwd" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection