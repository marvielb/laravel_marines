@extends('adminlte::page')

@section('title', 'Questions')

@section('content_header')
<div class="container">
    <div class="row">
        <h1>Question Groups</h1>
    </div>
</div>
@stop

@section('content')
<div id="app">
    <question-group-pager></question-group-pager>
</div>
@endsection
