@if($members->first())
<div class = "offset-sm-1 col-sm-4">
    @if(($team->leader)==Auth::id()|(Auth::user())==$team->project()->manager())
        @if(is_null($team->deputy))
        {{link_to_route('deputy.choice','サブリーダー選任',['id'=>$team->id],['class'=>'btn btn-outline-success btn-block'])}}
        @endif
    @endif
</div>
@endif