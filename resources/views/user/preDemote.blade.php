@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "centering">
    @if($user->leader())
    <h4>{{$user->firstName.' '.$user->lastName.' をリーダーから降格しますか？'}}</h4>
    @elseif($user->manager())
    <h4>{{$user->firstName.' '.$user->lastName.' をリーダーに降格しますか？'}}</h4>
    @elseif(($user->post())==4)
    <h4>{{$user->firstName.' '.$user->lastName.' の人事権限をなくしますか？'}}</h4>
    @endif
</div>
<div class = "row mt-4">
    <div class = "offset-sm-3 col-sm-3">
        {{link_to_route('users.demote','はい',['id'=>$user->id],['class'=>'btn btn-block btn-danger'])}}
        {{--<form method="POST" action="{{route('users.promote',['id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
            <button type="submit" class='btn btn-success btn-block'>はい</button>
        </form>--}}
    </div>
    <div class = "col-sm-3 ml-2">
        {{link_to_route('users.show','いいえ',[$user->id],['class'=>'btn btn-block btn-success'])}}
    </div>
</div>
@endsection('content')