@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6 mt-5'>
    <h3 class = 'text-center mt-3'>会社情報確認・変更</h3>
    <form method="POST" action="{{route('companies.update',[$company->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="companyName">会社名</label>
            <input type="text" class="form-control" name="companyName" value="{{$company->companyName}}">
        </div>
        <div class="form-group">
            <label for="companyPass">登録用パスワード</label>
            <input type="text" class="form-control" name="companyPass" value="{{$company->companyPass}}">
        </div>
        <div class="form-group">
            <label for="personnelPass">人事用パスワード</label>
            <input type="text" class="form-control" name="personnelPass" value="{{$company->personnelPass}}">
        </div>
        <button type="submit" class='btn btn-primary mt-4 offset-sm-2 col-sm-8'>変更</button>
    </form>
</div>
<div class = "offset-sm-4 col-sm-4 mt-5">
    {{link_to_route('users.show','戻る',[Auth::id()],['class'=>'btn btn-block btn-secondary'])}}
</div>
@endsection('content')