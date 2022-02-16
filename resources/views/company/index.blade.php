@extends('commons.layouts')
@include('commons.navbar')
@section('content')
<div class = "row">
    <div class = "col-sm-6">
        <div class = "text-center">
            <h4>{{'社員一覧'}}</h4>
        </div>
        @foreach ($users as $user)
        <div class = "mt-4 offset-sm-2">
            <h4>{{link_to_route('users.show',$user->firstName.' '.$user->lastName,[$user->id],[])}}</h4>
        </div>
        @endforeach
    </div>
    <div class = "col-sm-6">
        <div class = "text-center">
            <h4>{{'社員検索'}}</h4>
        </div>
        <div class = "mt-4">
            <form method ="GET" action = "{{route('users.search')}}">
                <input class = "form-control" type ="text" name = "name">
                <div class="text-center">
                    <button type="submit" class='btn btn-primary btn-lg mt-3 col-sm-6'>検索</button>
                </div> 
            </form>
        </div>
    </div>
</div>
@endsection('content')