@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<h3 class = "text-center">{{$user->firstName.' さんのメール一覧'}}</h3>
@if($recievedMessages)
    <h4 class = "ml-2">{{'受信メール'}}</h4>
    @foreach($recievedMessages as $message)
    <div class = "row">
        <div class = "col-sm-3 ml-5">
            <h4>{!!link_to_route('users.show',$message->sender()->firstName.' '.$message->sender()->lastName,[$message->sender()->id],[])!!}
        </div>
        <div class = "col-sm-5">
            <h4>{!!link_to_route('messages.show',$message->subject,[$message->id],[])!!}</h4>
        </div>
        <div class = "col-sm-2">
            @if(($message->status)=='unread')
            <h4>{!!link_to_route('messages.show','未読',[$message->id],['class'=>'btn btn-warning btn-block'])!!}</h4>
            @endif
            @if(($message->status)=='read')
            <h4>{!!link_to_route('messages.show','既読',[$message->id],['class'=>'btn btn-info btn-block'])!!}</h4>
            @endif
        </div>
    </div>
    @endforeach
@endif
@if($sentMessages)
    <h4 class ="mt-3 ml-2">{{'送信メール'}}</h4>
    @foreach($sentMessages as $message)
    <div class = "row">
        <div class = "col-sm-3 ml-5">
            <h4>{!!link_to_route('users.show',$message->reciever()->firstName.' '.$message->reciever()->lastName,[$message->reciever()->id],[])!!} </h4>
        </div>
        <div class = "col-sm-5">
            <h4>{!!link_to_route('messages.show',$message->subject,[$message->id],[])!!}</h4>
        </div>
        <div class = "col-sm-2">
            @if(($message->status)=='unsent')
            <h4>{!!link_to_route('messages.edit','未送信',[$message->id],['class'=>'btn btn-warning btn-block'])!!}</h4>
            @endif
        </div>
    </div>
    @endforeach
@endif
@if(!($recievedMessages)&&!($sentMessages))
<div class = "centering">
    <h3>{{'既存メールはまだありません'}}</h3>
</div>
@endif
@endsection('content')