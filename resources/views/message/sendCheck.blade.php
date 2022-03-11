@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<h5 class ="text-center mt-5 mb-4">{{"以下の内容でメッセージを送信します"}}</h5>
<div class = "offset-sm-1 col-sm-8">
    <a>{{"件名"}}</a>
    <div class = "offset-sm-2">
        <h4>{{$message->subject}}</h4>
    </div>
    <a class>{{"本文"}}</a>
    <div class = "offset-sm-2">
        <h3>{{$message->sentence}}</h3>
    </div>
</div>
@include('message.sendButton')
@endsection('content')