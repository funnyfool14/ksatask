@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "mt-t">
    <div class = "row justify-content-center">
        @if(($message->sender)==Auth::id())
            <h3>{{link_to_route('users.show',$reciever->firstName.' '.$reciever->lastName,[$reciever->id],[])}}</h3>
            <h3>{{'へのメール'}}</h3>
        @endif
        @if(($message->reciever)==Auth::id())
            <h3>{{link_to_route('users.show',$sender->firstName.' '.$sender->lastName,[$sender->id],[])}}</h3>
            <h3>{{'からのメール'}}</h3>
        @endif
    </div>
    <div class = "offset-sm-1">
        <div class = "mt-5 mt-5">
            <h3>{{$message->subject}}</h3>
        </div>
        <div class = "mt-5">
            <h3>{!!nl2br(e($message->sentence))!!}</h3>
        </div>
    </div>
    <div class = "offset-sm-4 col-sm-4 mt-5">
        @if(($message->sender)==Auth::id())
            @if(($message->status)=='unsent')
            <h3>{{link_to_route('messages.edit','メールの編集',[$message->id],['class'=>'btn btn-primary btn-block'])}}</h3>
            @else
            <h3>{{link_to_route('messages.write','メールの作成',[$message->reciever],['class'=>'btn btn-primary btn-block'])}}</h3>
            @endif
        @elseif(($message->reciever)==Auth::id())
            <h3>{{link_to_route('messages.reply','メールの返信',['message' => $message->id],['class'=>'btn btn-primary btn-block'])}}</h3>
        @endif
    </div>
    <div class="offset-sm-4 col-sm-4 mt-4 mb-5">
        {!!link_to_route('messages.index','メールボックス',[],['class'=>'btn btn-outline-primary btn-block'])!!}
    </div>
</div>
@endsection('content')