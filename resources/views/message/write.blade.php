@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "col-sm-10 text-center">
<h3 class = 'text-center mt-3'>メッセージ送信</h3>
    <form method="POST" action="{{route('messages.sendCheck',['id' => $user->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for='subject'>件名</label>
        <input type="text" class="form-control" name="subject" value="{{old('subject')}}">
    </div>
    <div class="form-group">
        <label for='sentence'>本文</label>
        <input type="text" style ="height:300px" class="form-control" name="sentence" value="{{old('sentence')}}">
    </div>
    <div class="text-center mt-5 mb-5">
        <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>送信</button>
    </div> 
    </form>
</div>
@endsection('content')
