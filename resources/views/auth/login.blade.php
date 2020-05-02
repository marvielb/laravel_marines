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
                        <input id="marinenum" type="text" class="form-control  @error('marinenum') is-invalid @enderror" name="marinenum" value="{{ old('marinenum') }}" required autocomplete="off" autofocus placeholder="Marines Serial No." />
                        
                        
                        @error('marinenum')
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
                            <a class="btn btn-link forgtpwd" data-target="#forgotPass">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="forgotPass" tabindex="-1" role="dialog" aria-labelledby="forgotPassLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="forgotPassLabel">Forgot Password?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input id="modalTxtMarineNum" type="text" class="form-control" name="modalTxtMarineNum" 
                           required autocomplete="off" autofocus placeholder="Marines Serial No." />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" id="btnEmail">Send via e-mail</button>
                <button type="button" class="btn" id="btnTxt">Text me a login code</button>
            </div>
          </div>
        </div>
      </div>

@endsection