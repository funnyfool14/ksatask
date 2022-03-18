@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">  
    <h3 class="mt-5 mb-4">{{$task->title.' の変更依頼を取り消しますか？'}}</h3>
</div>
<form method="POST" action="{{route('tasks.askDelete',['task'=>$task->id])}}" enctype="multipart/form-data">
    @csrf
    <div class = "mt-5 row">
        <div class="offset-sm-2 col-sm-6 mb-4">
            <input type="text" class="form-control" name="email" value="ユーザのメールアドレス">
        </div>
        <div class = "col-sm-2">
        <button type="submit" class='btn btn-primary btn-block'>取消</button>
        </div>
    </div>
</form>
<div class = "offset-sm-4 col-sm-4">
    {{link_to_route('messages.show','中止',[$task->id],['class'=>'btn btn-block btn-secondary'])}}
</div>
@endsection('content')