@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = 'row'>
    @include('user.left')
    @include('user.right')
</div>
<div class = ''>
    @include('user.indexButton')
    @include('task.graph')
    @if(Auth::user()->superior())
        @include('project.createButton')
    @endif
</div>
@if(($user->id)==(Auth::id()))
<div class = ''>
    @include('task.create')
</div>
@endif
@endsection('content')