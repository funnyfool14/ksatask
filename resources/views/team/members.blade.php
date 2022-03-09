<div class = "col-sm-6 mt-5">
    <div class = "mb-4 row">
        <div class = "col-sm-3 mt-2">
            <a>{{'リーダー'}}</a>
        </div>
        <div class = "col-sm-6">
            <h3>{!!link_to_route('users.show',$team->leader()->firstName.' '.$team->leader()->lastName,[$team->leader()->id],[])!!}</h3>
        </div>
    </div>
    @if($team->deputy)
    <div class = "mb-4 row">
        <div class = "col-sm-3 mt-2">
            <a>{{'サブリーダー'}}</a>
        </div>
        <div class = "col-sm-6">
            <h3>{!!link_to_route('users.show',$team->deputy()->firstName.' '.$team->deputy()->lastName,[$team->deputy()->id],[])!!}</h3>
        </div>
        <div class = "col-sm-3">
            @if(($team->leader)==Auth::id()|($team->project()->manager())==Auth::user())
            {{link_to_route('deputy.kick','解任',['id' => $team->id],['class'=>'btn btn-outline-danger ml-3'])}}
            @endif
        </div>
    </div>
    @endif
    <div class = "offset-sm-2 mt-3">
        @foreach($members as $member)
        <div class = "row">
            @if(($member->post())==2)
            <h3 class='offset-sm-1 col-sm-6'>{!!link_to_route('users.show',$member->firstName.' '.$member->lastName,[$member->id],[])!!}</h3>
            <div class = 'mt-2 col-sm-4'>
                @if(($team->leader)==Auth::id()|($team->project()->manager())==Auth::user())
                {{link_to_route('teams.remove','チームから外す',['team'=>$team->id,'user'=>$member->id],['class'=>'btn btn-danger btn-bock btn-sm'])}}
                @endif
            </div>
            @endif
        </div>
        @endforeach
        @foreach($members as $member)
        <div class = "row">
            @if(($member->post())==1)
            <h3 class='offset-sm-1 col-sm-6'>{!!link_to_route('users.show',$member->firstName.' '.$member->lastName,[$member->id],[])!!}</h3>
            <div class = 'mt-2 col-sm-4'>
                @if(($team->leader)==Auth::id()|($team->project()->manager())==Auth::user())
                {{link_to_route('teams.remove','チームから外す',['team'=>$team->id,'user'=>$member->id],['class'=>'btn btn-danger btn-bock btn-sm'])}}
                @endif
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>