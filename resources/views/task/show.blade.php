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
<div class = 'offset-sm-2'>
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>{{'タイトル'}}</a>
        <h2>{!!$task->title!!}</h3>
        <div class = "ml-5">
            @if(($task->owned(Auth::id()))|Auth::id()==($task->register))
                @if(($task->status)=='ask')
                <span>{{link_to_route('messages.index','変更依頼中',[],["class"=>"btn btn-warning rounded-pill ml-5"])}}</span>
                @endif
                @if(($task->owned(Auth::id())))
                    @if(($task->status)=='unsent')
                    <span>{{link_to_route('messages.index','変更未送信',[],["class"=>"btn btn-secondary rounded-pill ml-5"])}}</span>
                    @endif
                @endif
            @endif
        </div>
    </div>
    @if($task->existInCharge())
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>担当者</a>
        <div class = "col-sm-6">
            @foreach($task->inCharge()->get() as $user)
            <h3 class = ''>{!!link_to_route('users.show',$user->firstName.' '.$user->lastName,[$user->id])!!}</h3>
            @endforeach
        </div>
    </div>
    @endif
    @if(($task->register) != (Auth::id()))
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>登録者</a>
        <h3 class = ''>{!!link_to_route('users.show',$task->register()->firstName.' '.$task->register()->lastName,[$task->register])!!}</h3>
    </div>
    @endif
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>重要度</a>
        @if(($task->importance)==1)
        <h3>高</h3>
        @elseif(($task->importance)==2)
        <h3>中</h3>
        @elseif(($task->importance)==3)
        <h3>低</h3>
        @endif
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>緊急度</a>
        @if(($task->urgency)==1)
        <h3>高</h3>
        @elseif(($task->urgency)==2)
        <h3>中</h3>
        @elseif(($task->urgency)==3)
        <h3>低</h3>
        @endif
    </div>
    <div class = 'row mt-4'>
        @if(($task->private)=='private')
        <a class = 'col-sm-2'>公開レベル</a>
        <h3>非公開</h3>
        @endif
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>期日</a>
        <h3>{!!$task->deadline!!}</h3>
    </div>
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>詳細</a>
        <h3>{!!nl2br(e($task->detail))!!}</h3>
    </div>
    @if(count($task->progresses())>=1)
    <div class = 'row mt-4'>
        <a class = 'col-sm-2'>進捗</a>
        <div class = "col-sm-10">
            @foreach($task->progresses() as $progress)
            <h3 class = "mt-3">{!!nl2br(e($progress->sentence))!!}</h3>
            <div class = "row">
                @if(($progress->user())==(Auth::user()))
                    @if($progress->today())
                    <div class = "col-sm-2">
                        {{link_to_route('progress.edit','編集',['progress'=>$progress->id],['class'=>'btn btn-block btn-primary btn-sm '])}}
                    </div>
                    <div class = "col-sm-2">
                        {{link_to_route('progress.predelete','削除',['progress'=>$progress->id],['class'=>'btn btn-block btn-danger btn-sm'])}}
                    </div>
                    <h4 class = "mt-1 mr-4">{{$progress->user()->firstName.' '.$progress->user()->lastName}}</h4>
                    @else
                    <h4 class = "offset-sm-4 mt-1 mr-4">{{$progress->user()->firstName.' '.$progress->user()->lastName}}</h4>
                    @endif
                @endif
                <h5 class = "mt-2">{{$progress->date()}}</h5>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@include('task.editButton')
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