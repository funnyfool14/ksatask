@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3>{{$project->projectName}}</h4>
</div>
<div class = "text-center">
    <h4>{{'チーム一覧'}}</h4>
</div>
@foreach ($teams as $team)
<div class = "mt-4 offset-sm-1">
    <div class = "row">
        <div class = "col-sm-4">
            <h4>{{link_to_route('teams.show',$team->teamName,[$team->id],[])}}</h4>
        </div>
        <div class = "col-sm-4">
            <h4>{{link_to_route('users.show',$team->leader()->firstName.' '.$team->leader()->lastName,[$team->leader],[])}}</h4>
        </div>
    </div>
</div>
@endforeach
@endsection('content')