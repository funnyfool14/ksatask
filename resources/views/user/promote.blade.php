@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    @if(($user->post())==1)
    <h4>{{$user->firstName.' '.$user->lastName.' をリーダーに昇格しますか？'}}</h4>
    @elseif($user->leader())
    <h4>{{$user->firstName.' '.$user->lastName.' をマネージャーに昇格しますか？'}}</h4>
    @elseif($user->manager())
    <h4>{{$user->firstName.' '.$user->lastName.' に人事権限を付与しますか？'}}</h4>
    @endif
    @include('user.tasks')
    <form method="POST" action="{{route('users.promote',['id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
        <div class = "mt-5 row">
            <div class="offset-sm-2 col-sm-6 mb-4">
                <input type="text" class="form-control" name="password" value="会社のログインパスワード">
            </div>
            <div class = "col-sm-2">
                <button type="submit" class='btn btn-success btn-block'>はい</button>
            </div>
        </div>
    </form>
    <div class = "offset-sm-4 col-sm-4">
        {{link_to_route('users.show','いいえ',[$user->id],['class'=>'btn btn-block btn-danger'])}}
    </div>
</div>
@endsection('content')