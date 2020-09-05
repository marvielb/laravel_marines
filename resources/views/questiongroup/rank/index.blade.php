@extends('adminlte::page')

@section('title', 'Questions')

@section('content_header')
<div class="container">
    <div class="row">
        <h1>Ranks for: {{ $questiongroup['description'] }}</h1>
    </div>
</div>
@stop

@section('content')

<div id="app">
    <question-group-rank-pager question-group-id="{{ $questiongroup['id'] }}"/>
</div>


@endsection
