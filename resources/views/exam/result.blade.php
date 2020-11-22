@extends('adminlte::page')

@section('title', 'Confirmation')



@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      <div id="app">
        <exam-result code="{{$exam_code}}"></exam-result>
      </div>
    </div>
  </div>
</div>

@endsection