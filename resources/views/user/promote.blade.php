@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    @if(($user->post())==1)
    <h3 class="mt-5 mb-4">{{$user->firstName.' '.$user->lastName.' をリーダーに昇格しますか？'}}</h4>
    @elseif($user->leader())
    <h3 class="mt-5 mb-4">{{$user->firstName.' '.$user->lastName.' をマネージャーに昇格しますか？'}}</h4>
    @elseif($user->manager())
    <h3 class="mt-5 mb-4">{{$user->firstName.' '.$user->lastName.' に人事権限を付与しますか？'}}</h4>
    @endif
    @include('user.tasks')
    <form method="POST" action="{{route('users.promote',['id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
        <div class = "mt-5 row">
            <div class="offset-sm-2 col-sm-6 mb-4">
                <input type="text" class="form-control" name="personnelPass" value="人事用パスワード">
            </div>
            <div class = "col-sm-2">
                <button type="submit" class='btn btn-success btn-block'>昇格</button>
            </div>
        </div>
    </form>
    <div class = "offset-sm-4 col-sm-4">
        {{link_to_route('users.show','取消',[$user->id],['class'=>'btn btn-block btn-secondary'])}}
    </div>
</div>
@endsection('content')