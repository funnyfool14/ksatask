@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<h3 class = 'text-center mt-3'>メッセージ送信</h3>
<form method="POST" action="{{route('messages.askCheck',['task' => $task->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class = "offset-sm-1 col-sm-10">
        <div class="form-group">
            <label for='subject'>件名</label>
            <input type="text" class="form-control" name="subject" value="{{$task->title.' に関する内容の変更をお願いします'}}">
        </div>
        <div class="form-group">
            <label for='sentence'>本文</label>
            <input type="text" style ="height:300px" class="form-control" name="sentence" value="{{old('sentence')}}">
        </div>
    </div>
    <div class="mt-5 mb-5">
        <button type="submit" class='btn btn-primary btn-lg mt-5 offset-sm-4 col-sm-4'>確認</button>
    </div>  
</form>
@endsection('content')