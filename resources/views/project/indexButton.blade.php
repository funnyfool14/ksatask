
@if($project->teams())
<div class="row mt-5 mb-5">
    <div class="offset-sm-2 col-sm-4">
        {!!link_to_route('projects.teams','チーム一覧',['id' => $project->id],['class'=>'btn btn-outline-success btn-block'])!!}
    </div>
    <div class="col-sm-4">
        {!!link_to_route('projects.members','プロジェクトメンバー',['id' => $project->id],['class'=>'btn btn-outline-primary btn-block'])!!}
    </div>
</div>
@endif
@if((Auth::user())==($project->manager()))
<div class="offset-sm-4 col-sm-4">
    {!!link_to_route('teams.ready','チーム作成',['id' => $project->id],['class'=>'btn btn-outline-success btn-block'])!!}
</div>
@endif