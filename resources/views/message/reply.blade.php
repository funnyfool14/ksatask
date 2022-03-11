@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "mb-5">
    <div class = "text-center">
         <h4>{{$sender->firstName.' '.$sender->lastName.' さんへの返信'}}</h4>
    </div>
    <div class = "">
    <h4 class ="ml-2 mb-3">{{$message->subject}}
        {{' '}}
        <h3>{{$message->sentence}}</h3>
    </div>
</div>
<form method="POST" action="{{route('messages.replyCheck',['id' => $message->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    @include('message.contents')
</form>
@endsection('content')