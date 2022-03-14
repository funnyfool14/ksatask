@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "mb-5">
    <div class = "text-center">
         <h4>{{$sender->firstName.' '.$sender->lastName.' さんへの返信'}}</h4>
    </div>
    <div class = "">
    <h4 class ="ml-2 mb-3">{{$message->subject}}
        <h3>{!!nl2br(e($message->sentence))!!}</h3>
    </div>
</div>
<form method="POST" action="{{route('messages.replyCheck',['id' => $message->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class = "offset-sm-1 col-sm-10">
    <div class="form-group">
        <label for='subject'>件名</label>
        <input type="text" class="form-control" name="subject" value="{{'Re:'.$message->subject}}">
    </div>
    <div class="form-group">
        <label for='sentence'>本文</label>
        <textarea type="text" style ="height:300px" class="form-control" name="sentence">{{$message->sentence}}</textarea>
    </div>
</div>
<div class="mt-5 mb-5">
    <button type="submit" class='btn btn-primary btn-lg mt-5 offset-sm-4 col-sm-4'>確認</button>
</div>  
</form>
@endsection('content')