<div class = "col-sm-6">
    @if($user->pic)
    <img class="userPic" src="{{asset('storage/'.$user->pic)}}" alt="">
    @else
    <img class="userPic" src="{{asset('image/user_pic.jpg')}}" alt="">
    @endif
    <div class = "row mt-2">
        <div class = 'name col-sm-8'>
            <h3>{{$user->firstName.' '.$user->lastName}}</h3>
        </div>
        @if(($user->id)==(\Auth::id()))
        <div class = "edit col-sm-4">
            {!!link_to_route('users.edit','編集',['user'=>$user->id],['class'=>'btn btn-outline-primary btn-block'])!!}
        </div>
        @else
        <div class = "col-sm-4">
            {{$user->position()}}
        </div>        
        @endif
    </div>
</div>

