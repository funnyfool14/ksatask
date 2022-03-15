@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<form method="POST" action="{{route('messages.askUpdate',['message' => $message->id ,'task' =>$task->id])}}" enctype="multipart/form-data">
    @include('message.editContents')
</form>
@endsection('content')