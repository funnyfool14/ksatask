@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3>{{$project->projectName}}</h3>
    <h3>メンバー一覧</h3>
</div>
<div class = "offset-sm-1 mt-5">
    <div class = "row">
        <a class = 'col-sm-2'>{{'マネージャー'}}</a>
        <h4>{{link_to_route('users.show',$project->manager()->firstName.' '.$project->manager()->lastName,[$project->manager()->id],[])}}</h4>
    </div>
    @if(count($project->teams()))
    <div class = "row">
        @foreach($members as $member)
            @if($member->leader())
            <a class = 'col-sm-2 mt-2'>{{'チームリーダー'}}</a>
            <h4>{{link_to_route('users.show',$member->leaderPick()->firstName.' '.$member->leaderPick()->lastName,[$project->manager()->id],[])}}</h4>
            @endif
        @endforeach
    </div>
    <div class = "offset-sm-2 mt-4">
        @foreach($members as $member)
            @if(($member->profile()->post)==1)
            <div class = "row">
                <h4 class = "mt-2 col-sm-3">{{link_to_route('users.show',$member->firstName.' '.$member->lastName,[$member->id],[])}}</h4>
                @if((Auth::id())==($project->manager))
                <div class = "offset-sm-1 col-sm-3">
                    {{link_to_route('projects.remove','プロジェクトから外す',['project'=>$project->id,'user'=>$member->id],['class'=>'btn btn-danger btn-block'])}}
                    {{--<a href="{{route('projects.remove).'?'.'project='.$project->id.'&'.'user='.$member->id}}" class='btn btn-danger btn-block'>'プロジェクトから外す'</a>--}}
                </div>
            </div>
            @endif
            @endif
        @endforeach
    </div>
    @endif
</div>
<div class = "mt-5 mt-5 offset-sm-4 col-sm-4">
    {{link_to_route('projects.show','プロジェクトTOP',['project'=>$project->id],['class' => 'btn btn-outline-success btn-block'])}}
</div>
@endsection('content')