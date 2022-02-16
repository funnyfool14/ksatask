@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h4>{{'プロジェクト一覧'}}</h4>
</div>
@foreach ($projects as $project)
<div class = "mt-4 offset-sm-1">
    <div class = "row">
        <div class = "col-sm-4">
            <h4>{{link_to_route('projects.show',$project->projectName,[$project->id],[])}}</h4>
        </div>
        <div class = "col-sm-4">
            <h4>{{link_to_route('users.show',$project->manager()->firstName.' '.$project->manager()->lastName,[$project->manager],[])}}</h4>
        </div>
        <div class = "col-sm-3">
            <div class = "row">
                <h4>{{'期日'}}</h4>
                <h4 class = "ml-3">{{$project->deadline}}</h4>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection('content')