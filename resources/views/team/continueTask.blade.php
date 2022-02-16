@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3>{{$task->team()->teamName}}</h3>
</div>
<div class = "text-center mb-4">
    <h3>{{$task->title.' の担当者'}}</h3>
</div>
@if($task->inCharge())
@foreach($task->inCharge()->get() as $member)
<div class = "row">
    <h4 class='offset-sm-4 col-sm-3 mt-2'>{{link_to_route('users.show',$member->firstName.' '.$member->lastName,[$member->id])}}</h4>
    <div class = "col-sm-2">
        {{--link_to_route('tasks.remove','担当から外す',['task'=$task->id&'user'=$member->id],['class'=>'btn btn-danger btn-block'])--}}
        {{link_to_route('tasks.remove','担当から外す',['task'=>$task->id,'user'=>$member->id],['class'=>'btn btn-danger btn-block'])}}
    </div>
</div>
@endforeach
@endif
<div class = "text-center mt-5">
    <h4>担当者の追加</h4>
</div>
<div class = "mt-4">
    <form method="POST" action="{{route('tasks.inCharge',['id'=>$task->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class = "row">
        <div class="offset-sm-4 col-sm-3">
            <label for='memberId'></label>
            <select class='form-control' name='memberId'>
                <option value=''disabled selected style='display:none;'>担当者</option>
                @foreach($task->team()->members()->get() as $member)
                    @if($member->notInChargeOf($task->id))
                    <option value='{{$member->id}}'@if(old('memberId')==$member->id) selected @endif>{{$member->firstName.' '.$member->lastName}}</option>
                    @endif
                @endforeach
            </select>
        </div>
            <div class="col-sm-2">
            <button type="submit" class='btn btn-primary btn-block ml-2 mt-2'>追加</button>
        </div> 
    </div>
    </form>
</div>
<div class = "offset-sm-5 col-sm-2 mt-5">
    {{link_to_route('tasks.show','登録',[$task->id],['class'=>'btn btn-success btn-block'])}}
</div>
@endsection('content')