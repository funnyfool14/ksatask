@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "offset-sm-9 col-sm-3">
    @if(Auth::user()->authority())
        @if(count($project->tasks()->get())==0)
            {{link_to_route('projects.preDelete','プロジェクトを削除する',['project'=>$project->id],['class'=>'btn btn-secondary btn-block btn-sm'])}}
        @endif
    @endif
</div>
<div class = "text-center">
    <h3>{{$project->projectName}}</h3>
</div>
<div class = "row">
    <div class = "col-sm-5 text-right mt-3">
        <div class = "row">
            <a class ="mt-2 col-sm-6">マネージャー</a>
            <h3 class = "ml-5">{!!link_to_route('users.show',$project->manager()->firstName.' '.$project->manager()->lastName,[$project->manager()->id])!!}</h3>
        </div>
        <div class = "row mt-5">
            <a class ="mt-2 col-sm-6">期日</a>
            <h3 class = "ml-5">{{$project->deadline}}</h3>
        </div>
    </div>
    <div class = "offset-sm-1 col-sm-6 mt-4">
        <h4>{!!nl2br(e($project->detail))!!}</h4>
    </div>
</div>
@include('project.indexButton')
@if($project->existTeam())
    @include('task.graph')
@endif
@endsection('content')