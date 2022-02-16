@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "centering">
    <h2>会社登録</h2>
</div>
<div class = "row mt-5">
    <div class = "offset-sm-3 col-sm-3">
        {!!link_to_route('companies.choice','会社に所属する',[],['class'=>'btn btn-outline-primary btn-block'])!!}
    </div>
    <div class = "col-sm-3">
    {!!link_to_route('companies.create','会社を作る',[],['class'=>'btn btn-outline-success btn-block'])!!}
    </div>
</div>
@endsection('content')