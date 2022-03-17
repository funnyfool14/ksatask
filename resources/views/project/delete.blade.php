@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "text-center">
    <h3 class="mt-5 mb-4">{{$project->projectName.' を削除しますか？'}}</h3>
        <form method="POST" action="{{route('projects.delete',[$project->id])}}" enctype="multipart/form-data">
            @csrf
            @include('commons.enterPass')
        </form>
    <div class = "offset-sm-4 col-sm-4">
        {{link_to_route('projects.show','取消',[$project->id],['class'=>'btn btn-block btn-success'])}}
    </div>
</div>
@endsection('content')