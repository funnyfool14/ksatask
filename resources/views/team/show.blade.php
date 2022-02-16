@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3>{!!$team->project()->projectName!!}</h3>
    <h3>{!!$team->teamName!!}</h3>
</div>
<div class = "row">
    @include('team.members')
    @if((Auth::user())==($team->leader())|(Auth::user())==($team->deputy()))
        @include('team.memberPick')
    @endif
</div>
<div class = "row mt-5">
    @if($members->first())
    @include('team.deputyPick')
    @endif
    @if((Auth::user())==($team->leader())|(Auth::user())==($team->deputy()))
    @include('team.taskCreateButton')
    @endif
</div>
<div class = "">
    @include('task.graph')
</div>
<div class = "offset-sm-4 col-sm-4 mt-4 mb-5">
    {{link_to_route('projects.show','プロジェクトTOP',['project'=>$team->projectId],['class' => 'btn btn-outline-success btn-block'])}}
</div>
@endsection('content')