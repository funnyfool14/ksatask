@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center mt-5">
    @if($user->leader())
    <h3 class="mt-5 mb-4">{{$user->firstName.' '.$user->lastName.' をリーダーから降格しますか？'}}</h4>
    @elseif($user->manager())
    <h3 class="mt-5 mb-4">{{$user->firstName.' '.$user->lastName.' をリーダーに降格しますか？'}}</h4>
    @elseif(($user->post())==4)
    <h3 class="mt-5 mb-4">{{$user->firstName.' '.$user->lastName.' の人事権限をなくしますか？'}}</h4>
    @endif
</div>
@include('user.tasks')
<form method="POST" action="{{route('users.demote',['id'=>$user->id])}}" enctype="multipart/form-data">
        @csrf
        <div class = "mt-5 row">
            <div class="offset-sm-2 col-sm-6 mb-4">
                <input type="text" class="form-control" name="personnelPass" value="人事用パスワード">
            </div>
            <div class = "col-sm-2">
                <button type="submit" class='btn btn-danger btn-block'>降格</button>
            </div>
        </div>
    </form>
    <div class = "offset-sm-4 col-sm-4">
        {{link_to_route('users.show','取消',[$user->id],['class'=>'btn btn-block btn-secondary'])}}
    </div>
</div>
@endsection('content')