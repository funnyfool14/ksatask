<form method="POST" action="{{route('companies.belong',[])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="my-4">
        <input type="text" class="form-control" name="companyPass" value="{{old('companyPass')}}">
    </div>
    <div class="offset-sm-4 col-sm-4 mb-5">
        <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>登録</button>
    </div> 
</form>