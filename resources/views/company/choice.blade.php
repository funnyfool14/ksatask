@extends('commons.layouts')
@include('commons.navbar')
@section('content') 
<div class = "centering">
    <h4>会社情報を入力してください</h4>
</div>
@include('company.enterPass')
@endsection('content')