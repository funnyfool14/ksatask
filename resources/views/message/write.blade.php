@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<h3 class = 'text-center mt-3'>メッセージ送信</h3>
<form method="POST" action="{{route('messages.sendCheck',['id' => $user->id])}}" enctype="multipart/form-data">
    @csrf
    @method('POST')
    @include('message.contents')
</form>
@endsection('content')
