<div class = "offset-sm-3 col-sm-6">
    <form method="POST" action="{{route('companies.belong',[])}}" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mt-4">
            <label for="companyName">会社名</label>
            <input type="text" class="form-control" name="companyName" value="{{old('companyName')}}">
        </div>
        <div class="mt-4">
            <label for="companyPass">会社パスワード</label>
            <input type="text" class="form-control" name="companyPass" value="{{old('companyPass')}}">
        </div>
        <div class="mb-5 offset-sm-2 col-sm-8">
            <button type="submit" class='btn btn-primary btn-lg btn-block mt-5'>登録</button>
        </div> 
    </form>
</div>