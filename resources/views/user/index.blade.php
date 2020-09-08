@extends('adminlte::page')

@section('title', 'Marines Personnel')

@section('content_header')
<div class="container">
    <div class="row">
        <h1>Marines Personnel</h1>
    </div>
</div>
@stop


@section('content')
<div id="app">
    <user-pager></user-pager>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
