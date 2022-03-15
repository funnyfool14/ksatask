@extends('commons.layouts')
@include('commons.navbar')
@section('content')
@include('message.check')
<div class = "row mt-5">
    <div class = "offset-sm-2 col-sm-2">
        {{link_to_route('messages.send','送信する',['id' => $message->id],['class'=>'btn btn-block btn-primary'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.edit','編集する',[$message->id],['class'=>'btn btn-block btn-success'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.unsent','下書きに保存',['id' => $message->id],['class'=>'btn btn-block btn-secondary'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.preDelete','削除',[$message->id],['class'=>'btn btn-block btn-danger'])}}
    </div>
</div>
@endsection('content')