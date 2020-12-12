@extends('adminlte::page')

@section('title', 'Ranks')

@section('content_header')
<div class="container">
  <div class="row">
    <h1>Question Classification</h1>
  </div>
</div>
@stop


@section('content')
<div id="app">
  <question-classification-pager></question-classification-pager>
</div>
@endsection

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop