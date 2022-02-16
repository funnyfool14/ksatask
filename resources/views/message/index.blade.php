@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<h3 class = "">{{$user->firstName.' さんのメール一覧'}}</h3>
<h4 class = "ml-2">{{'受信メール'}}</h4>
@foreach($user->recievedMessages() as $message)
<div class = "row">
    <div class = "col-sm-3 ml-5">
        <h4>{!!link_to_route('users.show',$message->sender()->firstName.' '.$message->sender()->lastName,[$message->sender()->id],[])!!}
    </div>
    <h4>{{$message->subject}}</h4>
</div>
@endforeach
<h4 class ="mt-3 ml-2">{{'送信メール'}}</h4>
@foreach($user->sentMessages() as $message)
<div class = "row">
<div class = "col-sm-3 ml-5">
    <h4>{!!link_to_route('users.show',$message->reciever()->firstName.' '.$message->reciever()->lastName,[$message->sender()->id],[])!!} </h4>
</div>    
    <h4>{{$message->subject}}</h4>
</div>
@endforeach
@endsection('content')