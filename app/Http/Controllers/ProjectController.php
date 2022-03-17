<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as PostRequest;
use \App\Company;
use \App\Project;
use \App\Team;
use \App\User;
use \App\Task;
use \App\Profile;
use \DB;
use \App\Message;
use Mail;
use \App\Mail\SendMessage;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = \Auth::user()->company();
        $projects = $company->projects();

        return view ('project.index',[
            'company' => $company,
            'projects' => $projects, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();

        $company = $user->profile()->company();
        $users = $company->superior();
            
        return view ('project.create',[
            'user' => $user,
            'company' => $company,
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'projectName'=>'max:30|required',
            'manager'=>'required',
            'deadline'=>'required',
            'detail'=>'max:400|required']); 
            
            $user = \Auth::user();
            $company = $user->profile()->company();
            
            $project = new Project;
            $project->companyId = $company->id;
            $project->projectName = $request->projectName;
            $project->manager = $request->manager;
            $project->deadline = $request->deadline;
            $project->detail = $request->detail;
            $project->save();

            if(($request->manager)!=\Auth::id()){

            $user = User::find($request->manager);
        
            $message = new Message;
            $message->sender = \Auth::id();
            $message->reciever = $request->manager;
            $message->subject = 'プロジェクトマネージャー任命';
            $message->sentence = $user->firstName.' '.$user->lastName.' さんを'.$project->projectName.' のプロジェクトマネージャーに任命しました。プロジェクト画面から、チームの編成をしてください。';
            $message->status = "unread";
    
            $message->save();
    
            $reciever = User::find($message->reciever);
            Mail::to($reciever->email)->send(new SendMessage($message));

            }
            
            return redirect(route('projects.show',[
                'project' => $project,
            ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::find($id);

        //if(count($project->teams())){
        if($project->existTeam()){
            $highlowTasks = $project->tasks()->public()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highmidTasks = $project->tasks()->public()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highhighTasks = $project->tasks()->public()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midlowTasks = $project->tasks()->public()->midlow()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midmidTasks = $project->tasks()->public()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midhighTasks = $project->tasks()->public()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowlowTasks = $project->tasks()->public()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowmidTasks = $project->tasks()->public()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowhighTasks = $project->tasks()->public()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
        
            return view ('project.show',[
                'project' => $project,
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

        /*$highlowTasks = null;
        $highmidTasks = null;
        $highhighTasks = null;
        $midlowTasks = null;
        $midmidTasks = null;
        $midhighTasks = null;
        $lowlowTasks = null;
        $lowmidTasks = null;
        $lowhighTasks = null;*/
        
        return view ('project.show',[
            'project' => $project, 
            /*'highlowTasks' => $highlowTasks,
            'highmidTasks' => $highmidTasks,
            'highhighTasks' => $highhighTasks,
            'midlowTasks' => $midlowTasks,
            'midmidTasks' => $midmidTasks,
            'midhighTasks' => $midhighTasks,
            'lowlowTasks' => $lowlowTasks,
            'lowmidTasks' => $lowmidTasks,
            'lowhighTasks' => $lowhighTasks,*/
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::find($id);
        $company = \Auth::user()->company();
        $users = $company->superior();

        return view ('project.edit',[
            'project' => $project,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'projectName'=>'max:30|required',
            'manager'=>'required',
            'deadline'=>'required',
            'detail'=>'max:400|required']);

            $project = Project::find($id);
            $manager = $project->manager;

            $project->projectName = $request->projectName;
            $project->manager = $request->manager;
            $project->deadline = $request->deadline;
            $project->detail = $request->detail;
            $project->save();

            if(($request->manager!=$manager)){
                if(($request->manager)!=\Auth::id()){
                    $user = User::find($request->manager);
                
                    $message = new Message;
                    $message->sender = \Auth::id();
                    $message->reciever = $request->manager;
                    $message->subject = 'プロジェクトマネージャー任命';
                    $message->sentence = $user->firstName.' '.$user->lastName.' さんを'.$project->projectName.' のプロジェクトマネージャーに任命しました。プロジェクト画面から、チームの編成をしてください。';
                    $message->status = "unread";
            
                    $message->save();
            
                    $reciever = User::find($message->reciever);
                    Mail::to($reciever->email)->send(new SendMessage($message));
                }
            }

        return redirect(route('projects.show',[
        'project' => $id,
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function preDelete($projectId)
    {
        $project = Project::find($projectId);

        return view ('project.delete',[
            'project' => $project,
        ]);
    }

    public function delete(Request $request, $projectId)
    {
        $project = Project::find($projectId);

        if(($request->email)==(\Auth::user()->email)){
                
            $project->delete();

            return redirect(route('users.show',[
                'user' => \Auth::user(),
            ]));
        }

        return view ('project.cantDelete',[
            'project' => $project,
        ]);
    }

    public function members($id)
    {
        $project = Project::find($id);

        if($project->existTeam()){
            $leaders = $project->teams()->leaders();
            $members = $project->teams()->collectionMembers()->diff($leaders);
            
            return view ('project.members',[
                'project' => $project,
                'leaders' => $leaders,
                'members' => $members,
            ]);
        }

        return view ('project.members',[
            'project' => $project,
        ]);
    }

    public function teams($id)
    {
        $project = Project::find($id);

        if($project->existTeam()){
            return redirect(route('teams.index',[
                'id' => $id,
            ]));
        }

        if((\Auth::user())==($project->manager())|(\Auth::user()->post())>=4)
        return redirect (route('teams.ready',[
            'id' => $id
        ])); 

        return redirect(route('projects.show',[
        'project' => $id,
        ]));
    }

    public function remove($projectId, $userId)
    {
        $project = Project::find($projectId);
        $user = User::find($userId);

        return view('project.remove',[
            'project' => $project,
            'user' => $user
        ]);
    }

    public function memberDelete($projectId, $userId)
    {
        $teams = Project::find($projectId)->teams();
        foreach($teams as $team){
            $team->members()->detach($userId);
        }
        
        return redirect(route('projects.members',[
            'id' => $projectId,
        ]));
    }
}
