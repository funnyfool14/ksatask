@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3 class="mt-5 mb-4">メールアドレスが間違っています</h3>
</div>
<form method="POST" action="{{route('messages.delete',['message'=>$message->id])}}" enctype="multipart/form-data">
    @csrf
    @include('commons.enterPass')
</form>
<div class = "offset-sm-4 col-sm-4">
    {{link_to_route('messages.show','取消',[$message->id],['class'=>'btn btn-block btn-success'])}}
</div>
@endsection('content')