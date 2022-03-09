@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3>{{$project->projectName}}</h4>
    <h4 class = 'mt-1'>{{'チーム一覧'}}</h4>
</div>
@include('team.list')
<div class = "offset-sm-4 col-sm-4 mt-5 mt-5 mb-5">
    {{link_to_route('projects.show','プロジェクトTOP',['project'=>$project->id],['class' => 'btn btn-outline-success btn-block'])}}
</div>
@endsection('content')