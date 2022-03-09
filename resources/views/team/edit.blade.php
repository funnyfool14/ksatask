@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6 mt-5'>
    <h3 class = 'text-center mt-3'>チーム編集</h3>
    <form method="POST" action="{{route('teams.update',['id' => $team->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class = "text-center mt-4">
        <h4>{{$team->project()->projectName}}</h4>
    </div>
        <div class="form-group">
            <label for="teamName">チーム名</label>
            <input type="text" class="form-control" name="teamName" value="{{$team->teamName}}">
        </div>
        <div class="form-group">
            <label for='leader'>チームリーダー</label>
            <select class='form-control' name='leader'>
                <option value="{{$team->leader}}" style='display:none;'>{{$team->leader()->firstName.' '.$team->leader()->lastName}}</option>
                @foreach($users as $user)
                <option value='{{$user->id}}'@if(old('leader')==$user->id) selected @endif>{{$user->firstName.' '.$user->lastName}}</option>
                @endforeach
            </select>
        </div>
        <div class="text-center mt-5 mb-5">
            <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>編集終了</button>
        </div> 
    </form>
</div>
@endsection('content')