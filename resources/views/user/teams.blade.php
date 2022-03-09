@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3>{{link_to_route('users.show',$user->firstName.' '.$user->lastName,['user'=>$user->id],[])}}</h3>
    <h4 class = 'mt-1'>{{'参加チーム一覧'}}</h4>
</div>
@include('team.list')
@endsection('content')