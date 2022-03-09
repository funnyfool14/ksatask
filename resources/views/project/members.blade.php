@extends('commons.layouts')
@include('commons.navbar')
@section('content')
    <div class = "text-center">
        <h3>{{$project->projectName}}</h3>
        <h3>メンバー一覧</h3>
    </div>
    <div class = "offset-sm-1 mt-5">
        <div class = "row">
            <h4 class = "col-sm-4">{{link_to_route('users.show',$project->manager()->firstName.' '.$project->manager()->lastName,[$project->manager()->id],[])}}</h4>
            <a class = 'col-sm-3'>{{'(プロジェクトマネージャー)'}}</a>
        </div>
        @if($project->existTeam())
    {{--マネージャーがチームリーダー--}}
            @foreach($leaders as $leader)
                @if(($leader->profile()->post)>=3)
                    @if($leader!=($project->manager()))
                    <div class = "row">
                        <h4 class = "mt-2 col-sm-4">{{link_to_route('users.show',$leader->firstName.' '.$leader->lastName,[$leader->id],[])}}</h4>
                        <a class = 'col-sm-2'>{{'(チームリーダー)'}}</a>
                    </div>
                    @endif
                @endif
            @endforeach
    {{--リーダーがチームリーダー--}}
            @foreach($leaders as $leader)
                @if(($leader->profile()->post)==2)
                    @if($leader!=($project->manager()))
                    <div class = "row">
                        <h4 class = "mt-2 col-sm-4">{{link_to_route('users.show',$leader->firstName.' '.$leader->lastName,[$leader->id],[])}}</h4>
                        <a class = 'col-sm-2'>{{'(チームリーダー)'}}</a>
                    </div>
                    @endif
                @endif
            @endforeach
    {{--リーダーが一般メンバー--}}
    <div class = "mt-3 ml-2">
            @foreach($members as $member)
                @if(($member->profile()->post)==2)
                    @if($project->notLeaders($member->id))
                    <div class = "row">
                        <h4 class = "mt-2 col-sm-4">{{link_to_route('users.show',$member->firstName.' '.$member->lastName,[$leader->id],[])}}</h4>
                        @if((Auth::id())==($project->manager))
                        <div class = "col-sm-2">
                            {{link_to_route('projects.remove','プロジェクトから外す',['project'=>$project->id,'user'=>$member->id],['class'=>'btn btn-danger btn-block btn-sm'])}}
                        </div>
                        @endif
                    </div>
                    @endif
                @endif
            @endforeach
    {{--リーダーが一般メンバー--}}
            @foreach($members as $member)
                @if(($member->profile()->post)==1)
                    <div class = "row">
                        <h4 class = "mt-2 col-sm-4">{{link_to_route('users.show',$member->firstName.' '.$member->lastName,[$leader->id],[])}}</h4>
                        @if((Auth::id())==($project->manager))
                        <div class = "col-sm-2">
                            {{link_to_route('projects.remove','プロジェクトから外す',['project'=>$project->id,'user'=>$member->id],['class'=>'btn btn-danger btn-block btn-sm'])}}
                        </div>
                        @endif
                    </div>
                @endif
            @endforeach
        @endif {{--@if($project->existTeam())--}}
    </div>