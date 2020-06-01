@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1>Ranks for: {{ $questiongroup['description'] }}</h1>
    </div>
</div>
<div id="app">
    <question-group-rank-pager question-group-id="{{ $questiongroup['id'] }}"/>
</div>


@endsection
