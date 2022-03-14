<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use App\team;
use DB;
use \App\Message;
use Mail;
use \App\Mail\SendMessage;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'title'=>'required',
            'importance'=>'required',
            'urgency'=>'required',
            'private'=>'required',
            'detail'=>'max:400|required']);
 
        $user = \Auth::user();
        $task = new Task;

        $task->register = $user->id;
        $task->title = $request->title;
        $task->importance = $request->importance;
        $task->urgency = $request->urgency;
        $task->private = $request->private;
        $task->detail = $request->detail;
        $task->deadline = $request->deadline;
        $task->save();

        $user->makeTask($task);

        return redirect(route('users.top'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view ('task.show',[
            'task' => $task,
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
        $task = Task::find($id);
        return view ('task.edit',[
            'task' => $task,
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
            'title'=>'required',
            'importance'=>'required',
            'urgency'=>'required',
            'private'=>'required',
            'detail'=>'max:400|required']);

        $user = \Auth::user(); 
        $task = Task::find($id);

        $task->title = $request->title;
        $task->importance = $request->importance;
        $task->urgency = $request->urgency;
        $task->private = $request->private;
        $task->detail = $request->detail;
        $task->deadline = $request->deadline;
        $task->save();
    
        return redirect(route('tasks.show',[
            'task' => $task,
        ]));
        
    }

    public function teamCreate($id)
    {
        $team = Team::find($id);
        $members = $team->members()->get();

        return view('team.createTask',[
            'members' => $members,
            'team' => $team,
        ]);
    }

    public function teamStore(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'importance'=>'required',
            'urgency'=>'required',
            'detail'=>'max:400|required']);
 
        $team = Team::find($id);
        $task = new Task;

        $task->register = \Auth::id();
        $task->title = $request->title;
        $task->importance = $request->importance;
        $task->urgency = $request->urgency;
        $task->private = 'public';
        $task->detail = $request->detail;
        $task->teamId = $id;
        $task->deadline = $team->project()->deadline;
        if($request->deadline){
            $task->deadline = $request->deadline;
        }
        $task->save();

        return view ('team.continueTask',[
            'task' => $task,
        ]);
    }

    public function teamUpdate(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'importance'=>'required',
            'urgency'=>'required',
            'private'=>'required',
            'detail'=>'max:400|required']);
   
        $task = Task::find($id);

        $task->title = $request->title;
        $task->importance = $request->importance;
        $task->urgency = $request->urgency;
        $task->detail = $request->detail;
        $task->deadline = $request->deadline;
        $task->save();

        return view ('team.continueTask',[
            'task' => $task,
        ]);
        
    }

    public function progress($taskId)
    {
        $task = Task::find($taskId);

        return view ('task.progress',[
            'task' => $task,
        ]);
    }

    public function progressUp(Request $request, $taskId)
    {
        $task = Task::find($taskId);

        $task->progress= $request->progress;
        $task->save();

        return view ('task.show',[
            'task' => $task,
        ]);
    }


    public function inCharge(Request $request, $taskId)
    {
        $member = User::find($request->memberId);
        $task = Task::find($taskId);
        $team = Team::find($task->teamId);

        if($member){
            if($member->notInChargeOf($taskId)){
                $member->makeTask($task);
            }
            if(\Auth::user()!=$member){
                $message = new Message;
                $message->sender = \Auth::id();
                $message->reciever = $request->memberId;
                $message->subject = '担当タスクの追加';
                $message->sentence = $team->teamName.' の'.$task->title." が\n".$member->firstName.' '.$member->lastName.' さんに振り分けられました。';
                $message->status = "unread";

                $message->save();

                $reciever = User::find($message->reciever);
                Mail::to($reciever->email)->send(new SendMessage($message));
            }
        }

        return view('team.continueTask',[
            'task' => $task,
        ]);
    }

    public function remove($taskId,$userId)
    {
        $task = Task::find($taskId);
        $task->inCharge()->detach($userId);

        return view('team.continueTask',[
            'task' => $task,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function preDelete($id)
    {
        $task = Task::find($id);

        return view ('task.delete',[
            'task' => $task,
        ]);
    }

    public function delete(Request $request, $taskId)
    {
        $task = Task::find($taskId);
        
        if(($request->email)==(\Auth::user()->email)){
            if($task->teamId){
                $team = Team::find($task->teamId);
                
                $task->delete();

                return redirect(route('teams.show',[
                    'id' => $team->id,
                ]));
            }

            $task->delete();

            return redirect(route('users.show',[
                'user' => \Auth::user(),
            ]));
        }

        return redirect (route('tasks.show',[
            'task' => $task,
        ]));

    }

    public function ask($taskId)
    {
        $task = Task::find($taskId);
        
        return view ('task.ask',[
            'task' => $task,
        ]);
    }
}
