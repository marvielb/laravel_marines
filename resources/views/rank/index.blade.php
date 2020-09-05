@extends('adminlte::page')

@section('title', 'Ranks')

@section('content_header')
<div class="container">
    <div class="row">
        <h1>Ranks</h1>
    </div>
</div>
@stop


@section('content')
<div id="app">
    <rank-pager></rank-pager>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
