<div class = "offset-sm-1 col-sm-10">
    <div class="form-group">
        <label for='subject'>件名</label>
        <input type="text" class="form-control" name="subject" value="{{old('subject')}}">
    </div>
    <div class="form-group">
        <label for='sentence'>本文</label>
        {{--<input type="text" style ="height:300px" class="form-control" name="sentence" value="{{old('sentence')}}">--}}

        <textarea type="text" style ="height:300px" class="form-control" name="sentence">{{old('sentence')}}</textarea>
    </div>
</div>
<div class="mt-5 mb-5">
    <button type="submit" class='btn btn-primary btn-lg mt-5 offset-sm-4 col-sm-4'>確認</button>
</div>  