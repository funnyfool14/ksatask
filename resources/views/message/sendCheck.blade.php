@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<h5 class ="text-center mt-5 mb-4">{{"以下の内容でメッセージを送信します"}}</h5>
<div class = "offset-sm-1 col-sm-8">
    <a>{{"件名"}}</a>
    <div class = "offset-sm-2">
        {{$message->subject}}
    </div>
    <a class>{{"本文"}}</a>
    <div class = "offset-sm-2">
        {{$message->sentence}}
    </div>
</div>
<div class = "row mt-4">
    <div class = "offset-sm-3 col-sm-2">
        {{link_to_route('messages.send','はい',['id' => $message->id],['class'=>'btn btn-block btn-outline-primary'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.edit','編集する',['message' => $message->id],['class'=>'btn btn-block btn-outline-success'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.destroy','やめる',['message' => $message->id],['class'=>'btn btn-block btn-outline-danger'])}}
    </div>
</div>
@endsection('content')