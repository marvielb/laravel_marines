@extends('adminlte::page')

@section('title', 'Confirmation')



@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div id="app">
                <exam-question exam_code="{{Session::get('active_exam_code')}}"></exam-question>
            </div>
        </div>
    </div>
</div>

@endsection