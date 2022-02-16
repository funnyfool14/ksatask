<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as PostRequest;
use App\Project;
use App\Team;
use App\User;
use App\Task;
use \DB;

class TeamController extends Controller
{

    public function ready($id)
    {

        $project = Project::find($id);
        $users = \Auth::user()->company()->users();

        return view ('team.ready',[
            'project' => $project,
            'users' => $users,
        ]); 

    }

    public function leaderDecide(Request $request, $projectId)
    {
        $project = Project::find($projectId);
        $users = \Auth::user()->company()->users();

        $team = new Team;
        $team->projectId = $projectId;
        $team->teamName = $request->teamName;
        $team->leader = $request->leader;
        $team->deputy = null;
        if($request->deputy){
            $team->deputy = $request->deputy;
        };
        $team->save();

        $team->members()->attach($team->leader);
        if($team->deputy){
            $team->members()->attach($team->deputy);
        }
        
        return redirect(route('teams.show',[
            'id' => $team->id,
        ]));
    }

    public function index($id)
    {
        $project = Project::find($id);
        $teams = $project->teams();

        return view ('team.index',[
            'project' => $project,
            'teams' => $teams,
        ]);
    }

    public function show($teamId)
    {
        $team = Team::find($teamId);
        $users = \Auth::user()->company()->users();

        $members = $team->membersLeader();
        if($team->deputy){
            $members = $team->membersDeputy();
        };
        
        if($team->tasks()->get()){
            
            $highlowTasks = $team->tasks()->public()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highmidTasks = $team->tasks()->public()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highhighTasks = $team->tasks()->public()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midlowTasks = $team->tasks()->public()->midlow()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midmidTasks = $team->tasks()->public()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midhighTasks = $team->tasks()->public()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowlowTasks = $team->tasks()->public()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowmidTasks = $team->tasks()->public()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowhighTasks = $team->tasks()->public()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            
            return view('team.show',[
                'users' => $users,
                'team' => $team,
                'members' =>$members,
                'highlowTasks' => $highlowTasks,
                'highmidTasks' => $highmidTasks,
                'highhighTasks' => $highhighTasks,
                'midlowTasks' => $midlowTasks,
                'midmidTasks' => $midmidTasks,
                'midhighTasks' => $midhighTasks,
                'lowlowTasks' => $lowlowTasks,
                'lowmidTasks' => $lowmidTasks,
                'lowhighTasks' => $lowhighTasks,
            ]);
        }

        return view('team.show',[
            'users' => $users,
            'team' => $team,
            'members' =>$members,
        ]);
    }

    public function memberPost(Request $request, $teamId)
    {
        $team = Team::find($teamId);
        if(DB::table('teamsUsers')->where('userId',$request->userId)->doesntExist()){
            $team->members()->attach($request->userId);
        };

        return redirect(route('teams.show',[
            'id' => $team->id,
        ]));
    }

    public function deputyChoice($id)
    {
        $team = Team::find($id);
        $members = $team->membersLeader();

        return view ('team.deputyChoice',[
            'team' => $team,
            'members' => $members,
        ]);
    }

    public function deputyPick(Request $request, $id)
    {
        $team = Team::find($id);

        $team->deputy = $request->deputy;
        $team->save();

        return redirect(route('teams.show',[
            'id' => $team->id,
        ]));
    }

    public function deputyKick($id)
    {
        $team = Team::find($id);

        $team->deputy = null;
        $team->save();

        return redirect(route('teams.show',[
            'id' => $team->id,
        ]));
        
    }

    public function remove($teamId, $userId)
    {
        $team = Team::find($teamId);
        $user = User::find($userId);
        $tasks = $user->tasks()->get()->where('teamId',$teamId);

        return view('team.remove',[
            'team' => $team,
            'user' => $user,
            'tasks' => $tasks,
        ]);
    }

    public function memberDelete($teamId, $userId)
    {
        $team = Team::find($teamId);
        $team->members()->detach($userId);

        $tasks = Task::where('teamId',$teamId)->get();
        foreach($tasks as $task){
            $task->inCharge()->detach($userId);
        }

        return redirect(route('teams.show',[
            'id' => $teamId,
        ]));
    }
}
