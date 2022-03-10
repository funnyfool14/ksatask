@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3 class = "mt-5 mb-5">{{$user->firstName.' '.$user->lastName.' に関する人事'}}</h3>
    <div class = "offset-sm-3 col-sm-6 mt-5">
    @if(($user->id)!=(Auth::id()))
        @if(($user->profile()->post)>=1)
            @if(($user->profile()->post)<=3)
            <div class = "mt-2">
                {{link_to_route('users.prePromote','昇格',['id'=>$user->id],['class'=>'btn btn-success btn-block'])}}
            </div>
            @endif
        @endif
        @if(($user->profile()->post)>=2)
            @if(($user->profile()->post)<=4)
            <div class = "mt-2">
                {{link_to_route('users.preDemote','降格',['id'=>$user->id],['class'=>'btn btn-danger btn-block'])}}
            </div>
            @endif
        @endif
        <div class = "mt-5">
            {{link_to_route('users.preRetirement','退職',['id'=>$user->id],['class'=>'btn btn-secondary btn-block'])}}
        </div>
    @endif
    </div>
</div>
@endsection('content')