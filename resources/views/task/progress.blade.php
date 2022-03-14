@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6'>
        <h3 class = 'text-center mt-3'>{{$task->title}}</h3>
        <h3 class = 'text-center mt-3'>{{'タスク進捗登録'}}</h3>
        @if($task->teamId)
        <form method="POST" action="{{route('tasks.progressUp',['task'=>$task->id])}}" enctype="multipart/form-data">
        @else
        <form method="POST" action="{{route('tasks.progressUp',['task'=>$task->id])}}" enctype="multipart/form-data">
        @endif
        @csrf
        @method('PUT')
        @if($task->progress)
        <input type="text" style ="height:300px" class="form-control" name="progress" value="{{$task->progress}}">
        @else
        <input type="text" style ="height:300px" class="form-control" name="progress" value="{{old('progress')}}">
        @endif
            <div class="text-center mt-5 mb-5">
                <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>進捗更新</button>
            </div> 
        </form>
    </div>
@endsection('content')