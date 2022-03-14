@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6 mt-5'>
    <div class = "text-center mt-4">
        <h4>{{$project->projectName.' プロジェクト'}}</h4>
    </div>
    <h3 class = 'text-center mt-3'>チーム作成</h3>
    <form method="POST" action="{{route('teams.leaderDecide',['id' => $project->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
        <div class="form-group">
            <label for="projectName">チーム名</label>
            <input type="text" class="form-control" name="teamName" value="{{old('teamName')}}">
        </div>
        <div class="form-group">
            <label for='leader'>チームリーダー</label>
            <select class='form-control' name='leader'>
                <option value=''disabled selected style='display:none;'>社員から選択</option>
                @foreach($users as $user)
                <option value='{{$user->id}}'@if(old('leader')==$user->id) selected @endif>{{$user->firstName.' '.$user->lastName}}</option>
                @endforeach
            </select>
        </div>
        {{--<div class="form-group">
            <label for='deputy'>サブリーダー</label>
            <select class='form-control' name='deputy'>
                <option value=''disabled selected style='display:none;'>選任しなくても可</option>
                <option value = 'null'>{{' '}}</option>
                @foreach($users as $user)
                <option value='{{$user->id}}'@if(old('deputy')==$user->id) selected @endif>{{$user->firstName.' '.$user->lastName}}</option>
                @endforeach
            </select>
        </div>--}}
        <div class="text-center mt-5 mb-5">
            <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>チーム結成</button>
        </div> 
    </form>
</div>
<div class = "offset-sm-4 col-sm-4 mt-5 mt-5 mb-5">
    {{link_to_route('projects.show','プロジェクトTOP',['project'=>$project->id],['class' => 'btn btn-outline-success btn-block'])}}
</div>
@endsection('content')