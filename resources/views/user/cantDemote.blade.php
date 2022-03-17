@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3 class="mt-5 mb-4">パスワードが間違っています</h3>
</div>
<form method="POST" action="{{route('users.demote',[$user->id])}}" enctype="multipart/form-data">
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
@endsection('content')