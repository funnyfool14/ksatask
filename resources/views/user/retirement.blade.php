@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3 class="mt-5 mb-4">{{$user->firstName.' '.$user->lastName.' を退職させますか？'}}</h3>
    @include('user.tasks')
        <form method="POST" action="{{route('users.retirement',['id'=>$user->id])}}" enctype="multipart/form-data">
            @csrf
            <div class = "mt-5 row">
                <div class="offset-sm-2 col-sm-6 mb-4">
                    <input type="text" class="form-control" name="password" value="ユーザのログインパスワード">
                </div>
                <div class = "col-sm-2">
                <button type="submit" class='btn btn-danger btn-block'>はい</button>
                </div>
            </div>
        </form>
    <div class = "offset-sm-4 col-sm-4">
        {{link_to_route('users.show','いいえ',[$user->id],['class'=>'btn btn-block btn-success'])}}
    </div>
</div>
@endsection('content')