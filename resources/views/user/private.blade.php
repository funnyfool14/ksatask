@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h4>{{$user->firstName.' '.$user->lastName.'さんの非公開タスク'}}</h4>
</div>
<div class = 'mt-4'>
    @include('task.graph')
</div>
@if(($user->id)==(Auth::id()))
<div class = ''>
    @include('task.create')
</div>
@endif
@endsection('content')