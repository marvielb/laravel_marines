@extends('adminlte::page')

@section('title', 'Questions')

@section('content_header')
<div class="container">
    <div class="row">
        <h1>Questions</h1>
    </div>
</div>
@stop


@section('content')
<div id="app">
    <question-pager></question-pager>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
