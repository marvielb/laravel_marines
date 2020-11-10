
@extends('layouts.welcome')

@section('welcome-content')
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 mb-20">
                <div class="card text-center mt-5 pt-3 shadow-lg p-3 mb-5 bg-white rounded usrtypcard_container">
                    <div class="card-body" style="background-color: unset;">
                        <h4 class="card-title">Select User Type</h4>
                        <div class="row pb-5 selection_container" style="width: 100%;">
                            <div class="col-md-6 mt-3 pt-5 applicant_container">
                                <a href="{{ url('/applicants') }}">
                                    <i class="fas fa-user-tie fa-10x mb-5 icon"></i>
                                </a>
                                <h3 class="icon-header">Applicant</h3>
                            </div>
                            <div class="col-md-6 mt-3 pt-5 marine_container">
                                <a href="{{ url('/login') }}">
                                    <i class="fas fa-dharmachakra fa-10x mb-5 icon"></i>
                                </a>
                                <h3 class="icon-header">Marine</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection
