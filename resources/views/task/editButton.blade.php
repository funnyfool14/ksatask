@if(($task->register)==Auth::id())
<div class = "row justify-content-center mt-5 mb-5">
    <div class = "col-sm-3">
        {{link_to_route('tasks.edit','編集',['task' => $task->id],['class' => 'btn btn-primary btn-block'])}}
    </div>
    <div class = "col-sm-3">
        {{link_to_route('tasks.progress','進捗入力',['task' => $task->id],['class' => 'btn btn-success btn-block'])}}
    </div>
    <div class = "col-sm-3">
        {{link_to_route('tasks.preDelete','削除',['task' => $task->id],['class' => 'btn btn-danger btn-block'])}}
    </div>
</div>
@elseif($task->teamId)
    @if(($task->register)==Auth::id())
    <div class = "row justify-content-center mt-5 mb-5">
        <div class = "col-sm-3">
            {{link_to_route('tasks.edit','編集',['task' => $task->id],['class' => 'btn btn-primary btn-block'])}}
        </div>
        <div class = "col-sm-3">
            {{link_to_route('tasks.progress','進捗入力',['task' => $task->id],['class' => 'btn btn-success btn-block'])}}
        </div>
        <div class = "col-sm-3">
            {{link_to_route('tasks.preDelete','削除',['task' => $task->id],['class' => 'btn btn-danger btn-block'])}}
        </div>
    </div>
    @elseif($task->incharge()->where('userId',Auth::id())->exists())
    <div class = "row mt-4">
        <div class = "offset-sm-3 col-sm-3">
            {{link_to_route('tasks.progress','進捗入力',['task' => $task->id],['class' => 'btn btn-primary btn-block'])}}
        </div>
        <div class = "col-sm-3">
            @if(($task->status)=='progress')
            {{link_to_route('messages.ask','変更依頼',['id' => $task->id],['class' => 'btn btn-warning btn-block'])}}
            @else
            {{link_to_route('tasks.askPredelete','変更依頼の取消',[$task->id],['class' => 'btn btn-warning btn-block'])}}
            @endif
        </div>
    </div>
    @endif
@endif