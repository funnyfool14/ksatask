@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6'>
    <h3 class = 'text-center mt-3'>{{$task->title}}</h3>
    <h3 class = 'text-center mt-3'>{{'タスク進捗編集'}}</h3>
    <form method="POST" action="{{route('progress.update',['progress'=>$progress->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <textarea type="text" class="form-control" style ="height:100px" name="sentence">{{$progress->sentence}}</textarea>
        <div class="text-center mt-5 mb-5">
            <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>進捗更新</button>
        </div> 
    </form>
</div>
@include('task.back')
@endsection('content')