@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6 mt-5'>
    <h3 class = 'text-center mt-3'>プロジェクトの立ち上げ</h3>
    <form method="POST" action="{{route('projects.store',[])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
        <div class="form-group">
            <label for="projectName">プロジェクト名</label>
            <input type="text" class="form-control" name="projectName" value="{{old('projectName')}}">
        </div>
        <div class="form-group">
            <label for='manager'>プロジェクトマネージャー</label>
            <select class='form-control' name='manager'>
                {{--<label for='manager'>マネージャー</label>--}}
                <option value=''disabled selected style='display:none;'>マネージャー以上の役職者から選択</option>
                @foreach($users as $user)
                <option value='{{$user->id}}'@if(old('manager')==$user->id) selected @endif>{{$user->firstName.' '.$user->lastName}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="deadline">期日</label>
            <input type="date" class="form-control" name="deadline" value="{{old('deadline')}}">
            <option value=''disabled selected style='display:none;'>期日がない場合は記入不要</option>
        </div>
        <div class='form-group'>
            <label for="detail">詳細</label>
            <textarea type="text" class="form-control" name="detail">{{old('detail')}}</textarea>
        </div>
        <div class="text-center mt-5 mb-5">
            <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>登録</button>
        </div> 
    </form>
</div>
@endsection('content')