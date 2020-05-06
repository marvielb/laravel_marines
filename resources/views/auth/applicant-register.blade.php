@extends('layouts.login')

@section('login-content')

    <div class="container login-container">
        <div class="row signin-container">
            <!-- <div class="col-md-8 logo-form">
                <div class="logo">
                    <img src="{{url('/img/marines.png')}}" alt="marines">
                </div>
                <div class="brand">
                    <h3>Marines Web-Based Examination System</h3>
                </div>
            </div> -->

            <div class="col-md-4 login-form">
                <h3>Applicant Registration</h3>

                <form method="POST" action="{{ url('/applicants') }}">
                    @csrf

                    <div class="form-group">
                        <input id="firstName" type="text" class="form-control  @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="off" autofocus placeholder="First Name" />
                        @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="middleName" type="text" class="form-control  @error('middleName') is-invalid @enderror" name="middleName" value="{{ old('middleName') }}" required autocomplete="off" autofocus placeholder="Middle Name" />
                        @error('middleName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="lastName" type="text" class="form-control  @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="off" autofocus placeholder="Last Name" />
                        @error('lastName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                       <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">+63</span>
                            </div>
                            <input type="text" class="form-control @error('mobileNumber') is-invalid @enderror" id="mobileNumber" name="mobileNumber" value="{{ old('mobileNumber') }}" required autocomplete="off" autofocus aria-describedby="basic-addon3">
                            @error('mobileNumber')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btnsubmit">
                            {{ __('Register') }}
                        </button>
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
