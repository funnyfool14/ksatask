@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<form method="POST" action="{{route('messages.update',[$message->id])}}" enctype="multipart/form-data">
    @include('message.editContents')
</form>
@endsection('content')