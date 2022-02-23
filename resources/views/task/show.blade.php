@extends('commons.layouts')
@include('commons.navbar')
@section('content')
@if($task->team())
<div class = "mt-4">
<h5 class = "text-center">{{$task->team()->teamName}}</h>
</div>
@endif
<div class = "mt-4">
    <h5 class = "text-center">{{'タスクの詳細'}}</h>
</div>
<div class = 'offset-sm-2 col-sm-8'>
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>{{'タイトル'}}</a>
        <h2>{!!$task->title!!}</h3>
    </div>
    @if($task->existInCharge())
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>担当者</a>
        <div class = "col-sm-6">
            @foreach($task->inCharge()->get() as $user)
            <h3 class = ''>{!!link_to_route('users.show',$user->firstName.' '.$user->lastName,[$user->id])!!}</h3>
            @endforeach
        </div>
    </div>
    @endif
    @if(($task->register) != (Auth::id()))
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>登録者</a>
        <h3 class = ''>{!!link_to_route('users.show',$task->register()->firstName.' '.$task->register()->lastName,[$task->register])!!}</h3>
    </div>
    @endif
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>重要度</a>
        @if(($task->importance)==1)
        <h3>高</h3>
        @elseif(($task->importance)==2)
        <h3>中</h3>
        @elseif(($task->importance)==3)
        <h3>低</h3>
        @endif
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>緊急度</a>
        @if(($task->urgency)==1)
        <h3>高</h3>
        @elseif(($task->urgency)==2)
        <h3>中</h3>
        @elseif(($task->urgency)==3)
        <h3>低</h3>
        @endif
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>詳細</a>
        <h2>{!!$task->detail!!}</h3>
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>公開レベル</a>
        @if(($task->private)=='public')
        <h3>公開</h3>
        @elseif(($task->private)=='private')
        <h3>非公開</h3>
        @endif
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>期日</a>
        <h3>{!!$task->deadline!!}</h3>
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-3'>詳細</a>
        <h3>{!!$task->detail!!}</h3>
    </div>
</div>
@if(($task->register)==Auth::id())
@include('task.editButton')
@endif
@if($task->teamId)
<div class = "row mt-4 mb-5">
    <div class = "offset-sm-3 col-sm-3">
        {{link_to_route('teams.show','チームTOP',[$task->team()->id],['class' => 'btn btn-outline-success btn-block'])}}
    </div>
    <div class = "col-sm-3">
        {{link_to_route('projects.show','プロジェクトTOP',['project'=>$task->team()->projectId],['class' => 'btn btn-outline-success btn-block'])}}
    </div>
</div>
@endif
@endsection('content')