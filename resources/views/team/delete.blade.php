@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3 class="mt-5 mb-4">{{$team->teamName.' を削除しますか？'}}</h3>
        <form method="POST" action="{{route('teams.delete',['id'=>$team->id])}}" enctype="multipart/form-data">
            @csrf
            <div class = "mt-5 row">
                <div class="offset-sm-2 col-sm-6 mb-4">
                    <input type="text" class="form-control" name="email" value="ユーザのメールアドレス">
                </div>
                <div class = "col-sm-2">
                <button type="submit" class='btn btn-danger btn-block'>はい</button>
                </div>
            </div>
        </form>
    <div class = "offset-sm-4 col-sm-4">
        {{link_to_route('teams.show','いいえ',['id'=>$team->id],['class'=>'btn btn-block btn-success'])}}
    </div>
</div>
@endsection('content')