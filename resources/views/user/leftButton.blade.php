    <div class="offset-sm-2 mt-4 col-sm-8">
        @if(($user->id)==Auth::id())
        {!!link_to_route('users.private','プライベート',['id'=>Auth::id()],['class'=>'btn btn-outline-success btn-block btn-lg'])!!}
        @endif
    </div>
    <div class="offset-sm-2 mt-4 col-sm-8">
        {!!link_to_route('users.deadline','期限付きタスク',['id'=>$user->id],['class'=>'btn btn-outline-danger btn-block btn-lg'])!!}
    </div>
    <div class="offset-sm-2 mt-4 col-sm-8">
        @if((Auth::id())==($user->id))
        {!!link_to_route('messages.index','メール',[],['class'=>'btn btn-outline-primary btn-block'])!!}
        @else
        {!!link_to_route('messages.write','メール',['user'=>$user->id],['class'=>'btn btn-outline-primary btn-block btn-lg'])!!}
        @endif
    </div>
    <div class="offset-sm-2 mt-5 mt-5 col-sm-8">
        @if((Auth::user())->team())
        {!!link_to_route('users.teams','参加チーム',['id'=>$user->id],['class'=>'btn btn-success btn-block btn-lg'])!!}
        @endif
    </div>
    <div class = "offset-sm-2 col-sm-8 mt-5 mt-4">
        @if(Auth::user()->authority())
        @if(($user->id)!=(Auth::id()))
            @if(($user->profile()->post)>=1)
            @if(($user->profile()->post)<=3)
            <div class = "mt-2">
                {{link_to_route('users.prePromote','昇格',['id'=>$user->id],['class'=>'btn btn-success btn-block'])}}
            </div>
            @endif
            @endif
            @if(($user->profile()->post)>=2)
            @if(($user->profile()->post)<=4)
            <div class = "mt-2">
                {{link_to_route('users.preDemote','降格',['id'=>$user->id],['class'=>'btn btn-danger btn-block'])}}
            </div>
            @endif
            @endif
        @endif
        @endif
    </div>