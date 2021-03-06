@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "centering">
    <h3>{{$project->projectName.' から'}}</h3>
    <h3 class="mt-4 mb-4">{{$user->firstName.' '.$user->lastName.' を外しますか？'}}</h3>
    @if($user->team()->get())
    <a>{{'参加チーム'}}</a>
    @foreach($user->team()->get() as $team)
        <h4>{{$team->teamName}}</h4>
    @endforeach
    @endif
</div>
<div class = "row mt-5">
    <div class = "offset-sm-3 col-sm-3 mr-2">
        {{link_to_route('projects.members','いいえ',['id'=>$project->id],['class'=>'btn btn-block btn-success'])}}
    </div>
    <div class = "col-sm-3 ml-2">
    {{link_to_route('projects.memberDelete','はい',['project'=>$project->id,'user'=>$user->id],['class'=>'btn btn-block btn-danger'])}}
    </div>
</div>
@endsection('content')