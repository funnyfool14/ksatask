@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">  
    <h3 class="mt-5 mb-4">{{$task->title.' の変更依頼を取り消しますか？'}}</h3>
</div>
<form method="POST" action="{{route('messages.askDelete',['message'=>$message->id,'task'=>$task->id])}}" enctype="multipart/form-data">
    @csrf
    @include('message.enterPass')
</form>
<div class = "offset-sm-4 col-sm-4">
    {{link_to_route('messages.show','いいえ',[$message->id],['class'=>'btn btn-block btn-success'])}}
</div>
@endsection('content')