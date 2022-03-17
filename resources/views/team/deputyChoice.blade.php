@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "centering">
    <h3>サブリーダー選任</h3>
</div>
<div class = "mt-4">
    <form method="POST" action="{{route('deputy.pick',['id'=>$team->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
        <div class="offset-sm-2 col-sm-8 mt-5">
            <label for='deputy'></label>
            <select class='form-control' name='deputy'>
                <option value=''disabled selected style='display:none;'>チームメンバーから選択</option>
                @foreach($members as $member)
                <option value='{{$member->id}}'@if(old('userId')==$member->id) selected @endif>{{$member->firstName.' '.$member->lastName}}</option>
                @endforeach
            </select>
        </div>
        <div class="offset-sm-5 col-sm-2 mt-5">
            <button type="submit" class='btn btn-success btn-block ml-2 mt-2'>任命</button>
        </div>
    </form>
</div>
@include('team.back')
@endsection('content')