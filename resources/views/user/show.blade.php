@extends('commons.layouts')
@include('commons.navbar')
@section('content')
    @if(Auth::user()->profile())
        @if(Auth::user()->profile()->companyId)
        <div class = "row">
            <div class = "offset-sm-1 col-sm-4">
                <h3>{{Auth::user()->company()->companyName}}</h3>
            </div>
            @if((Auth::user()->post())==5)
            <div class = "offset-sm-4 col-sm-3">
                {{link_to_route('companies.edit','会社情報確認・変更',[Auth::user()->company()->id],['class'=>'btn btn-secondary btn-block'])}}
            </div>
            @endif
        </div>
        @endif
    @endif
<div class = 'row'>
    @include('user.left')
    @include('user.right')
</div>
<div class = ''>
    @include('user.indexButton')
    @include('task.graph')
</div>
@if(($user->id)==(Auth::id()))
<div class = ''>
    @include('task.create')
</div>
@endif
@endsection('content')