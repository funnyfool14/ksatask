<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as PostRequest;
use App\Project;
use App\Team;
use App\User;
use App\Task;
use App\Message;
use \DB;
use Mail;
use \App\Mail\SendMessage;
use LDAP\Result;

class TeamController extends Controller
{

    public function ready($id) //create
    {

        $project = Project::find($id);
        $users = \Auth::user()->company()->leaders();
    
        return view ('team.ready',[
            'project' => $project,
            'users' => $users,
        ]); 

    }

    public function leaderDecide(Request $request, $projectId) //store
    {
        $project = Project::find($projectId);

        $team = new Team;
        $team->projectId = $projectId;
        $team->teamName = $request->teamName;
        $team->leader = $request->leader;
        $team->save();

        $team->members()->attach($team->leader);

        $user = User::find($request->leader);

        if($user!=(\Auth::user())){
            $message = new Message;
            $message->sender = \Auth::id();
            $message->reciever = $request->leader;
            $message->subject = 'チームリーダー任命';
            $message->sentence = $user->firstName.' '.$user->lastName.' さんを'.$team->project()->projectName.'プロジェクトの'.$team->teamName." のチームリーダーに任命しました。\nチーム画面からメンバーを組織しタスクを立ててください。";
            $message->status = "unread";

            $message->save();

            $reciever = User::find($message->reciever);
            Mail::to($reciever->email)->send(new SendMessage($message));
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
        $users = \Auth::user()->company()->lowly();
        
        $superiors = $team->superiors();
        $members = $team->lowlyMembers();
        /*$members = $team->membersLeader();
        if($team->deputy){
            $members = $team->membersDeputy();
        };
        if($team->superiors()){
            $superiors = $team->superiors();
        }*/

        
        if($team->tasks()->get()){
            
            $highlowTasks = $team->tasks()->public()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highmidTasks = $team->tasks()->public()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highhighTasks = $team->tasks()->public()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midlowTasks = $team->tasks()->public()->midlow()->paginate(4,['*'],'midlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midmidTasks = $team->tasks()->public()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midhighTasks = $team->tasks()->public()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowlowTasks = $team->tasks()->public()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowmidTasks = $team->tasks()->public()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowhighTasks = $team->tasks()->public()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            
            return view('team.show',[
                'users' => $users,
                'team' => $team,
                'members' =>$members,
                'superiors' => $superiors,
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
            'superiors' => $superiors,
        ]);
    }

    public function memberPost(Request $request, $teamId)
    {
        $team = Team::find($teamId);
        if(DB::table('teamsUsers')->where('teamId',$teamId)->where('userId',$request->userId)->doesntExist()){
            $team->members()->attach($request->userId);
        };
        
        $user = User::find($request->userId);

        $message = new Message;
        $message->sender = $team->project()->manager;
        $message->reciever = $request->userId;
        $message->subject = $team->teamName;
        $message->sentence = $user->firstName.' '.$user->lastName." さんを\n".$team->project()->projectName.'プロジェクトの'.$team->teamName."に召集しました。\n詳細は追って連絡します。";
        $message->status = "unread";

        $message->save();

        $reciever = User::find($message->reciever);
        Mail::to($reciever->email)->send(new SendMessage($message));

        return redirect(route('teams.show',[
            'id' => $teamId,
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

        $user = User::find($request->deputy);

        if($user!=($team->project()->manager())){
            $message = new Message;
            $message->sender = \Auth::id();
            $message->reciever = $request->deputy;
            $message->subject = 'サブリーダー任命';
            $message->sentence = $user->firstName.' '.$user->lastName." さんを\n".$team->project()->projectName.'プロジェクトの'.$team->teamName.' のサブリーダーに任命しました。';
            $message->status = "unread";

            $message->save();

            $reciever = User::find($message->reciever);
            Mail::to($reciever->email)->send(new SendMessage($message));
        }

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

    public function edit($id)
    {
        $team = Team::find($id);
        $leaders = \Auth::user()->company()->leaders();
        $leader = User::where('id',$team->leader)->get();
        $users = $leaders->diff($leader);

        return view ('team.edit',[
        'team' => $team,
        'users' => $users,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'teamName'=>'max:30|required',
            'leader'=>'required',]); 

        $team = Team::find($id);
        $leader = $team->leader();

        $team->teamName = $request->teamName;
        $team->leader = $request->leader;
        $team->save();

        $user = User::find($request->leader);

        if($user!=$leader){
            if(($request->leader)!=\Auth::id()){
                $message = new Message;
                $message->sender = \Auth::id();
                $message->reciever = $request->leader;
                $message->subject = 'チームリーダー任命';
                $message->sentence = $user->firstName.' '.$user->lastName." さんを\n".$team->project()->projectName.'プロジェクトの'.$team->teamName." のチームリーダーに任命しました。\nチーム画面からメンバーを組織しタスクを立ててください。";
                $message->status = "unread";

                $message->save();

                $reciever = User::find($message->reciever);
                Mail::to($reciever->email)->send(new SendMessage($message));
            }
        }

        if($team->members()->where('userId',$team->leader)->doesntExist()){
            $team->members()->attach($team->leader);
        }
        /*if($team->deputy){
            if($team->members()->where('userId',$team->deputy)->doesntExist()){
                $team->members()->attach($team->deputy);
            }
        }*/
        
        return redirect(route('teams.show',[
            'id' => $team->id,
        ]));
    }

    public function preDelete($teamId)
    {
        $team = Team::find($teamId);

        return view ('team.delete',[
            'team' => $team,
        ]);
    }

    public function delete(Request $request, $teamId)
    {
        $team = Team::find($teamId);
        
        if(($request->email)==(\Auth::user()->email)){
                $team->delete();

            $team->delete();

            return redirect(route('projects.show',[
                'project' => $team->project(),
            ]));
        }

        return redirect (route('teams.show',[
            'team' => $team,
        ]));

    }
}
