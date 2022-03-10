<form method="POST" action="{{route('companies.belong',[])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="my-4">
        <label for="companyName">会社名</label>
        <input type="text" class="form-control" name="companyName" value="{{old('companyName')}}">
    </div>
    <div class="my-4">
        <input type="text" class="form-control" name="companyPass" value="{{old('companyPass')}}">
    </div>
    <div class="offset-sm-4 col-sm-4 mb-5">
        <label for="companyPass">会社パスワード</label>
        <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>登録</button>
    </div> 
</form>