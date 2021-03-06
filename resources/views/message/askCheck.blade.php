@extends('commons.layouts')
@include('commons.navbar')
@section('content')
@include('message.check')
<div class = "row mt-4">
    <div class = "offset-sm-2 col-sm-2">
        {{link_to_route('messages.askSend','送信する',['message' => $message->id ,'task' =>$task->id],['class'=>'btn btn-block btn-primary'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.askEdit','編集する',['message' => $message->id ,'task' =>$task->id],['class'=>'btn btn-block btn-success'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.askUnsent','下書きに保存',['message' => $message->id ,'task' =>$task->id],['class'=>'btn btn-block btn-secondary'])}}
    </div>
    <div class = "col-sm-2">
        {{link_to_route('messages.askPreDelete','削除',['message'=>$message->id,'task'=>$task->id],['class'=>'btn btn-block btn-danger'])}}
    </div>
</div>
@endsection('content')