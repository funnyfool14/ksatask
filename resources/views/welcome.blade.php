@extends('commons.layouts')
@section('content')
@include('commons.navbar')
<div class = 'centering'>
    <h1>タスク管理</h1>
    <div class = 'row mt-5'>
        <div class = 'offset-sm-3 col-sm-3 mt-2'>
            {!!link_to_route('login','ログインする',[],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
        <div class = 'col-sm-3 mt-2'>
            {!!link_to_route('register','ユーザ登録する',[],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
    </div>
</div> 
@endsection('content')