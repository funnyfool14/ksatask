@extends('commons.layouts')
@include('commons.navbar')
@section('content') 
<div class = "centering">
    <h4>会社情報を入力してください</h4>
</div>
<div class = "offset-sm-3 col-sm-6">
    @include('company.enterPass')
</div>
@endsection('content')