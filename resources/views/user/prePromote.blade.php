@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "centering">
    @if(($user->post())==1)
    <h4>{{$user->firstName.' '.$user->lastName.' をリーダーに昇格しますか？'}}</h4>
    @elseif($user->leader())
    <h4>{{$user->firstName.' '.$user->lastName.' をマネージャーに昇格しますか？'}}</h4>
    @elseif($user->manager())
    <h4>{{$user->firstName.' '.$user->lastName.' に人事権限を付与しますか？'}}</h4>
    @endif
</div>
<div class = "row mt-4">
    <div class = "offset-sm-3 col-sm-3">
        {{link_to_route('users.promote','はい',['id'=>$user->id],['class'=>'btn btn-block btn-success'])}}
        {{--<form method="POST" action="{{route('users.promote',['id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
            <button type="submit" class='btn btn-success btn-block'>はい</button>
        </form>--}}
    </div>
    <div class = "col-sm-3 ml-2">
        {{link_to_route('users.show','いいえ',[$user->id],['class'=>'btn btn-block btn-danger'])}}
    </div>
</div>
@endsection('content')