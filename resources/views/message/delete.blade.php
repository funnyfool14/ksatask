@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3 class="mt-5 mb-4">{{$message->subject.' を削除しますか？'}}</h3>
        <form method="POST" action="{{route('messages.delete',[$message->id])}}" enctype="multipart/form-data">
            @csrf
            @include('message.enterPass')
        </form>
    <div class = "offset-sm-4 col-sm-4">
        {{link_to_route('messages.show','いいえ',[$message->id],['class'=>'btn btn-block btn-success'])}}
    </div>
</div>
@endsection('content')