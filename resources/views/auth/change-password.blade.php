@extends('layouts.password')

@section('login-content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body" id="form">
                        <h4 class="card-title text-center">Change Password</h4><hr>
                        <form method="POST" action="{{ url('/change_password') }}">
                            @csrf

                            @foreach ($errors->all() as $error)
                                <p class="text-danger">{{ $error }}</p>
                            @endforeach 

                            <div class="row">
                                <div class="col-md-12 old_password_container">
                                    <div class="form-group forms">
                                        <label for=oldPassword> Old Password : </label>
                                        <input type="password" name="oldPassword" id="oldPassword" class="form-control" autocomplete="oldPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 new_password_container">
                                    <div class="form-group forms">
                                        <label for=newPassword> New Password : </label>
                                        <input type="password" name="newPassword" id="newPassword" class="form-control" autocomplete="oldPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 cur_password_container">
                                    <div class="form-group forms">
                                        <label for=curNewPassword> Current New Password : </label>
                                        <input type="password" name="curNewPassword" id="curNewPassword" class="form-control" autocomplete="oldPassword">
                                    </div>
                                </div>
                            </div>
                            <div class="row note_container">
                                <div class="col-md-12">
                                    <p class="text-danger"><em> Note: New Password Should contain atlest 1 Uppercase and 1 number and a minimum of 8 characters </em> </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group button_container float-right mt-2 mb-0">
                                        <button type="submit" class="btn btn_changePass">Change Password</button>
                                        <a href="{{ url('/logout') }}" class="btn btn-danger">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection
