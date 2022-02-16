<ul>
<div class = "row">
    <li>{!!link_to_route('tasks.show',$task->title,['task' => $task->id],[])!!}</li>
    @if($task->teamId)
    @if((Auth::user())==(App\Team::find($task->teamId)->leader())|(Auth::user())==((App\Team::find($task->teamId)->deputy())))
    @if(is_null($task->inCharge()->first()))
    <div class = "ml-1 mt-1">
        <a class="btn-danger btn-sm">担当者不在</a>
    </div>
    @endif
    @endif
    @endif
</div>
</ul>