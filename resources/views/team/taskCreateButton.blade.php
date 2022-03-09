@if((Auth::user())==($team->leader())|(Auth::user())==($team->deputy())|(Auth::user())==$team->project()->manager())
<div class = 'offset-sm-1 col-sm-4'>
    {{link_to_route('tasks.teamCreate','タスクの作成',['id' => $team->id],['class'=>'btn btn-outline-primary btn-block'])}}
</div>
@endif