@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "centering">
    <h3>{{$team->teamName.' から'}}</h3>
    <h3 class="mt-4 mb-4">{{$user->firstName.' '.$user->lastName.' を外しますか？'}}</h3>
    @if($tasks)
    <a>{{'担当タスク'}}</a>
    @foreach($tasks as $task)
        <h4>{{$task->title}}</h4>
    @endforeach
    @endif
</div>
<div class = "row mt-5">
    <div class = "offset-sm-3 col-sm-3 mr-2">
        {{link_to_route('teams.show','いいえ',['id'=>$team->id],['class'=>'btn btn-block btn-success'])}}
    </div>
    <div class = "col-sm-3 ml-2">
    {{link_to_route('teams.memberDelete','はい',['teamId'=>$team->id,'userId'=>$user->id],['class'=>'btn btn-block btn-danger'])}}
    </div>
</div>
@endsection('content')