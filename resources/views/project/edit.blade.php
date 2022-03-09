@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<form method="POST" action="{{route('projects.update',['project'=>$project->id])}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="projectName">プロジェクト名</label>
            <input type="text" class="form-control" name="projectName" value={{$project->projectName}}>
        </div>
        @if((\Auth::user()->post())>=4)
        <div class="form-group">
            <label for='manager'>プロジェクトマネージャー</label>
            <select class='form-control' name='manager'>
                {{--<label for='manager'>マネージャー</label>--}}
                <option value='{{$project->manager()->id}}' style='display:none;'>{{$project->manager()->firstName.' '.$project->manager()->lastName}}</option>
                @foreach($users as $user)
                <option value='{{$user->id}}'@if(old('manager')==$user->id) selected @endif>{{$user->firstName.' '.$user->lastName}}</option>
                @endforeach
            </select>
        </div>
        @elseif((\Auth::user())==$project->manager())
        <div class="form-group">
            <label for='manager'>プロジェクトマネージャー</label>
            <select class='form-control' name='manager'>
                {{--<label for='manager'>マネージャー</label>--}}
                <option value='{{$project->manager()->id}}' style='display:none;'>{{$project->manager()->firstName.' '.$project->manager()->lastName}}</option>
            </select>
        </div>
        @endif
        <div class="form-group">
            <label for="deadline">期日</label>
            <input type="date" class="form-control" name="deadline" value="{{$project->deadline}}">
            <option value=''disabled selected style='display:none;'>期日がない場合は記入不要</option>
        </div>
        <div class='form-group'>
            <label for="detail">詳細</label>
            <input type="text" class="form-control" name="detail" value="{{$project->detail}}">
        </div>
        <div class="text-center mt-5 mb-5">
            <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>変更</button>
        </div> 
    </form>
</div>
@endsection('content')