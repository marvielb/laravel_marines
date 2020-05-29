@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Choices for: {{ $question['body'] }}</h1>
    </div>
</div>
<div id="app">
    <choice-pager question-id="{{$question['id']}}"></choice-pager>
</div>


@endsection
