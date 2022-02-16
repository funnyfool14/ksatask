@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6'>
    <h3 class = 'text-center mt-3'>会社登録</h3>
    <form method="POST" action="{{route('companies.store',[])}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="companyName">会社名</label>
            <input type="text" class="form-control" name="companyName" value="{{old('companyName')}}">
        </div>
        <div class="form-group">
            <label for="companyPass">パスワード(８文字以上)</label>
            <input type="text" class="form-control" name="companyPass" value="{{old('companyPass')}}">
        </div>
        <div class="text-center mt-5 mb-5">
            <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>登録</button>
        </div> 
    </form>
</div>
@endsection('content')