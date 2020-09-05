@extends('adminlte::page')

@section('title', 'Questions')

@section('content_header')
<div class="container">
    <div class="row">
        <h1>Choices for: {{ $question['body'] }}</h1>
    </div>
</div>
@stop

@section('content')
<div id="app">
    <choice-pager question-id="{{$question['id']}}"></choice-pager>
</div>
@endsection
