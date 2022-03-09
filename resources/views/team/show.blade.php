@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3>{!!$team->project()->projectName!!}</h3>
    <h3>{!!$team->teamName!!}</h3>
</div>
<div class = "row">
    @include('team.members')
    @include('team.memberPick')
</div>
<div class = "row mt-5">
    @include('team.deputyPick')
    @include('team.taskCreateButton')
</div>
<div class = "">
    @include('task.graph')
</div>
@if((Auth::user())==($team->project()->manager()))
    <div class = "offset-sm-4 col-sm-4 mt-4">
        {{link_to_route('teams.edit','チーム編集',['id'=>$team->id],['class' => 'btn btn-primary btn-block'])}}
    </div>
@endif
<div class = "offset-sm-4 col-sm-4 mt-4 mb-5">
    {{link_to_route('projects.show','プロジェクトTOP',['project'=>$team->projectId],['class' => 'btn btn-outline-success btn-block'])}}
</div>
@endsection('content')