@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "centering">
    <h4>該当する会社がありません</h4>
    <h4>再度会社パスワードを入力してください</h4>
</div>
@include('company.enterPass')
@endsection('content')