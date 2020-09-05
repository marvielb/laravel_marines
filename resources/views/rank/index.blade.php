@extends('adminlte::page')

@section('title', 'Ranks')

@section('content_header')
    <h1>Ranks</h1>
@stop


@section('content')
<div id="app">
    <rank-pager></rank-pager>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
