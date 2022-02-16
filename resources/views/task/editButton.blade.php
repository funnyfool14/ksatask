<div class = "row mt-4">
    <div class = "offset-sm-3 col-sm-3">
        {{link_to_route('tasks.edit','編集',['task' => $task->id],['class' => 'btn btn-primary btn-block'])}}
    </div>
    <div class = "col-sm-3">
        {{link_to_route('tasks.edit','削除',['task' => $task->id],['class' => 'btn btn-danger btn-block'])}}
    </div>
</div>