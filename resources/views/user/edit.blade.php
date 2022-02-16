@extends('commons.layouts')
@section('content')
<form method="POST" action="{{route('users.update',['user'=>$user->id])}}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class = "row">
    <div class='col-sm-6'>
    <h4 class = "mt-5 text-center">プロフィール編集</h4>
        <div class = "row mt-5">
            <div class="form-group">
                <label for="firstName">姓</label>
                <input type="text" class="form-control" name="firstName" value="{{$user->firstName}}">
            </div>
            <div class="form-group ml-3">
                <label for="coment">名</label>
                <input type="text" class="form-control" name="lastName" value="{{$user->lastName}}">
            </div>
        </div>
        <div class="form-group mt-3 row">
            <label for="companyName">好きな言葉</label>
            @if($profile->maxim)
            <input type="text" class="form-control" name="maxim" value="{{$profile->maxim}}">
            @else
            <input type="text" class="form-control" name="maxim" value="{{old('maxim')}}">
            @endif
        </div>
        <div class="form-group mt-3 row">
            <label for="coment">一言コメント</label>
            @if($profile->coment)
            <input type="text" class="form-control" name="coment" value="{{$profile->coment}}">
            @else
            <input type="text" class="form-control" name="coment" value="{{old('coment')}}">
            @endif
        </div>
        <label for="pic mt-3">写真の変更</label>
        <div class="form-group row">
            <input type="file" name="pic">
        </div>
    </div>
    <div class = "col-sm-6">
        @if($user->pic)
        <img class="userPic"src="{{asset('storage/'.$user->pic)}}"alt="">
        @else
        <img class="userPic"src="{{asset('image/user_pic.jpg')}}" alt="">
        @endif
    </div>
</div>
<div class="mt-5 offset-sm-2 col-sm-8">
    <button type="submit" class='btn btn-outline-primary btn-lg btn-block'>登録</button>
</div> 
</form>
@endsection('content')