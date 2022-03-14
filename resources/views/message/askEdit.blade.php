@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<form method="POST" action="{{route('messages.askUpdate',['message' => $message->id ,'task' =>task->id])}}" enctype="multipart/form-data">
    @include('message.edirContents')
</form>
@endsection('content')