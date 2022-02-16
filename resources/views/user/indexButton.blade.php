@if($user->profile())
@if($user->profile()->company())
<div class="row mt-5 mb-5">
    <div class="offset-sm-2 col-sm-4">
        {!!link_to_route('projects.index','プロジェクト一覧',[],['class'=>'btn btn-outline-success btn-block'])!!}
    </div>
    <div class="col-sm-4">
        {!!link_to_route('companies.index','社員一覧',[],['class'=>'btn btn-outline-primary btn-block'])!!}
    </div>
</div>
@endif
@endif