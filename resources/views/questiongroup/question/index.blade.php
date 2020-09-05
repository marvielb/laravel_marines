@extends('adminlte::page')

@section('title', 'Questions')

@section('content_header')
<div class="container">
    <div class="row">
        <h1>Questions for: {{ $questiongroup['description'] }}</h1>
    </div>
</div>
@stop

@section('content')
<div id="app">
    <question-group-question-pager question-group-id="{{ $questiongroup['id'] }}"/>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
