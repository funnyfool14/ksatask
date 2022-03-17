<div class = "text-center mt-5">
    @if(count($user->team()->get())>=1)
        <a>{{'参加チーム'}}</a>
        @foreach($user->team()->get() as $team)
            <h4 class = "mt-2">{{$team->teamName}}</h4>
                @if(count($team->userTasks($user->id))>=1)
                <a class = "mt-3">{{'担当タスク'}}</a>
                <div class ="row justify-content-center mt-2">
                    @foreach($team->userTasks($user->id) as $task)
                    <h5 class = "ml-4">{{$task->title}}</5>
                    @endforeach
                </div>
                @endif
        @endforeach
    @endif
</div>