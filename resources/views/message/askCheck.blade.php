@extends('commons.layouts')
@include('commons.navbar')
@section('content')
@include('message.check')
<div class = "row mt-4">
    <div class = "offset-sm-3 col-sm-2">
        {{link_to_route('messages.askSend','送信する',['message' => $message->id ,'task' =>task->id],['class'=>'btn btn-block btn-outline-primary'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.askEdit','編集する',['message' => $message->id ,'task' =>task->id],['class'=>'btn btn-block btn-outline-success'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.askUnsent','下書きに保存',['message' => $message->id ,'task' =>task->id],['class'=>'btn btn-block btn-outline-danger'])}}
    </div>
</div>
@endsection('content')