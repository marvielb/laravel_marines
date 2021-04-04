@extends('adminlte::page')

@section('title', 'SMS Sender')

@section('content_header')

@stop

@section('content')
<div class="sms-container">
  <div class="sms-panel" style="width:50%; margin-right:10px">
    <span>Message</span>
    <div>
      <textarea style="width: 100%; height: 95%">Message Here</textarea>
    </div>
  </div>
  <div class="sms-panel">
    <span>Send To</span>
    <div id="app">
      <sms-sender-pager></sms-sender-pager>
    </div>
  </div>

  @endsection

  @section('css')
  <link rel="stylesheet" href="/css/admin_custom.css">
  @stop

  <style>
    .sms-container {
      display: flex;
      width: 100%;
      justify-content: space-between;
    }

    .sms-panel {
      width: 100%;
      padding: 1rem;
      border: 1px solid #ccc !important;
    }
  </style>