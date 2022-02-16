@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6'>
        <h3 class = 'text-center mt-3'>タスク登録</h3>
        @if($task->teamId)
        <form method="POST" action="{{route('tasks.teamUpdate',['id'=>$task->id])}}" enctype="multipart/form-data">
        @else
        <form method="POST" action="{{route('tasks.update',['task'=>$task->id])}}" enctype="multipart/form-data">
        @endif
        @csrf
        @method('PUT')
            <div class="form-group">
                <label for="title">タイトル</label>
                <input type="text" class="form-control" name="title" value="{{$task->title}}">
            </div>
            <div class="form-group">
                <label for='importance'>重要度</label>
                <select class='form-control' name='importance' value = "{{$task->importance}}">
                    <option value='{{$task->importance}}' style={{$task->importance}}>{{$task->importance()}}</option>
                    <option value='1' @if(old('importance')=='1') selected @endif>高</option>
                    <option value='2' @if(old('importance')=='2') selected @endif>中</option>
                    <option value='3' @if(old('importance')=='3') selected @endif>低</option>
                </select>
            </div>
            <div class="form-group">
                <label for='urgency'>緊急度</label>
                <select class='form-control' name='urgency' value = "{{$task->urgency}}">
                    <option value='{{$task->urgency}}' style={{$task->urgency}}>{{$task->urgency()}}</option>
                    <option value='1' @if(old('urgency')=='1') selected @endif>高</option>
                    <option value='2' @if(old('urgency')=='2') selected @endif>中</option>
                    <option value='3' @if(old('urgency')=='3') selected @endif>低</option>
                </select>
            </div>
            <div class="form-group">
                <label for='private'>公開/非公開</label>
                <select class='form-control' name='private' value = "{{$task->privateStatus()}}">
                    <option value='{{$task->private}}' style = {{$task->private}}>{{$task->privateStatus()}}</option>
                    <option value='public' @if(old('private')=='public') selected @endif>公開</option>
                    <option value='private' @if(old('private')=='private') selected @endif>非公開</option>
                </select>
            </div>
            <div class="form-group">
                <label for="deadline">期日</label>
                <input type="date" class="form-control" name="deadline" value="{{$task->deadline}}">
            <div class='form-group'>
                <label for="detail">詳細</label>
                <input type="text" class="form-control" name="detail" value="{{$task->detail}}">
            </div>
            @if($task->teamId)
            <div class="text-center mt-5 mb-5">
                <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>担当者編集</button>
            </div> 
            @else
            <div class="text-center mt-5 mb-5">
                <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>更新</button>
            </div> 
            @endif
        </form>
    </div>
@endsection('content')