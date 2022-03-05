@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
            <h3>{{$project->projectName}}</h3></div>
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
        <h4>{{$project->detail}}</h4>
    </div>
</div>
@include('project.indexButton')
@if(count($project->teams()))
<div class = "">
    @include('task.graph')
</div>
@endif
@endsection('content')