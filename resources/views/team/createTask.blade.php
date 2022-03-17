@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class='offset-sm-3 col-sm-6 mt-5'>
    <h3 class = 'text-center mt-3'>タスク登録</h3>
    <form method="POST" action="{{route('tasks.teamStore',['id'=>$team->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" name="title" value="{{old('title')}}">
        </div>
        {{--<div class="form-group">
            <label for='inCharge'>担当者</label>
            <select class='form-control' name='inCharge'>
                <label for='inCharge'>担当者</label>
                <option value=''disabled selected style='display:none;'>選択は必須ではない</option>
                <option value=''>担当者なし</option>
                @foreach($users as $user)
                <option value='{{$user->id}}'@if(old('inCharge')==$user->id) selected @endif>{{$user->firstName,' ',$user->lastName}}</option>
                @endforeach
            </select>
        </div>--}}
        <div class="form-group">
            <label for='importance'>重要度</label>
            <select class='form-control' name='importance'>
                <option value=''disabled selected style='display:none;'>重要度の選択</option>
                <option value='1' @if(old('importance')=='1') selected @endif>高</option>
                <option value='2' @if(old('importance')=='2') selected @endif>中</option>
                <option value='3' @if(old('importance')=='3') selected @endif>低</option>
            </select>
        </div>
        <div class="form-group">
            <label for='urgency'>緊急度</label>
            <select class='form-control' name='urgency'>
                <option value=''disabled selected style='display:none;'>緊急度の選択</option>
                <option value='1' @if(old('urgency')=='1') selected @endif>高</option>
                <option value='2' @if(old('urgency')=='2') selected @endif>中</option>
                <option value='3' @if(old('urgency')=='3') selected @endif>低</option>
            </select>
        </div>
        <div class="form-group">
            <label for="deadline">期日</label>
            <input type="date" class="form-control" name="deadline" value="{{old('deadline')}}">
        </div>
        <div class='form-group'>
            <label for="detail">詳細</label>
            <textarea type="text" class="form-control" style ="height:100px" name="detail">{{old('detail')}}</textarea>
        </div>
        <div class="text-center mt-5 mb-5">
            <button type="submit" class='btn btn-primary btn-lg mt-5 col-sm-8'>登録</button>
        </div> 
    </form>
</div>
@include('team.back')
@endsection('content')