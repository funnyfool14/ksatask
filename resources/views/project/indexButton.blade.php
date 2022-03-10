
@if($project->teams())
<div class="row mt-5 mb-3">
    <div class="offset-sm-2 col-sm-4">
        {!!link_to_route('projects.teams','チーム一覧',['id' => $project->id],['class'=>'btn btn-outline-success btn-block'])!!}
    </div>
    <div class="col-sm-4">
        {!!link_to_route('projects.members','プロジェクトメンバー',['id' => $project->id],['class'=>'btn btn-outline-primary btn-block'])!!}
    </div>
</div>
@endif
@if((Auth::user())==($project->manager())|(Auth::user())->authority())
<div class="row mb-5">
<div class="offset-sm-2 col-sm-4 ">
    {!!link_to_route('teams.ready','チーム作成',['id' => $project->id],['class'=>'btn btn-success btn-block'])!!}
</div>
    <div class="col-sm-4">
    {!!link_to_route('projects.edit','プロジェクト編集',['project' => $project->id],['class'=>'btn btn-primary btn-block'])!!}
    </div>
</div>
</div>
@endif