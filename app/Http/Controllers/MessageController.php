<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Message;
use App\User;
use App\Task;
use \App\Mail\SendMessage;
use App\Mail\SendTestMail;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $user = \Auth::user();

        $recievedMessages = $user->recievedMessages();
        $sentMessages = $user->sentMessages();

        return view ('message.index',[
            'user' => $user,
            'recievedMessages' => $recievedMessages,
            'sentMessages' => $sentMessages,
        ]);
    }


    public function write($id)
    {
        $user = User::find($id);

        return view ('message.write',[
            'user' => $user,
        ]);
    }

    public function sendCheck(Request $request , $id){
        $request->validate([
            'subject'=>'required',
            'sentence'=>'required',
        ]);

        $reciever = User::find($id);
    	$message = new Message;

        $message->sender = \Auth::id();
        $message->reciever = $id;
        $message->subject = $request->subject;
        $message->sentence = $request->sentence;
        $message->status = "unread";

        $message->save();

        return view ('message.sendCheck',[
            'message' => $message,
        ]);
    }

    public function send($id)
    {
        $message = Message::find($id);
        $reciever = User::find($message->reciever);

        Mail::to($reciever->email)->send(new SendMessage($message));

        return redirect (route('messages.index'));
    }

    public function unsent($messageId)
    {
        $message = Message::find($messageId);
        $message->status ='unsent';
        $message->save();

        return redirect (route('messages.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reply($messageId)
    {
        $message = Message::find($messageId);
        $sender = User::find($message->sender);
        $message->sentence = "\n\n>>>\n$message->sentence";
        $message->save();
        
        return view ('message.reply',[
            'message' => $message,
            'sender' => $sender,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function replyCheck(Request $request , $messageId){

        $request->validate([
            'subject'=>'required',
            'sentence'=>'required',
        ]);

        $beforeMessage = Message::find($messageId);
    	$message = new Message;

        $message->sender = \Auth::id();
        $message->reciever = $beforeMessage->sender;
        $message->subject = $request->subject;
        $message->sentence = $request->sentence;
        $message->before = $messageId;
        $message->status = "unread";

        $message->save();

        return view ('message.replyCheck',[
            'message' => $message,
            'beforeMessage' => $beforeMessage,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $reciever= User::find($message->reciever);
        $sender = User::find($message->sender);
        IF((\Auth::user())==$reciever){
            $message->status = 'read';
            $message->save();
        }

        return view ('message.show',[
            'message' => $message,
            'reciever' => $reciever,
            'sender' => $sender,
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
        $message = Message::find($id);
        
        return view ('message.edit',[
            'message' => $message,
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
        $message = Message::find($id);
        
        $message->subject = $request->subject;
        $message->sentence = $request->sentence;
        $message->status = 'unread';

        $message->save();

        return view ('message.sendCheck',[
            'message' => $message,
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
        $message = Message::find($id);

        return view ('message.delete',[
            'message' => $message,
        ]);
    }
    public function delete(Request $request, $messageId)
    {
        $message = Message::find($messageId);
        
        if(($request->email)==\Auth::user()->email){

            $message->delete();

            return redirect(route('messages.index'));
        }

        return view ('message.cantDelete',[
        'message' => $message,
        ]);
    }

    public function ask($taskId)
    {
        $task = Task::find($taskId);
        
        return view ('message.ask',[
            'task' => $task,
        ]);
    }
    
    public function askCheck(Request $request , $taskId){

        $request->validate([
            'subject'=>'required',
            'sentence'=>'required',
        ]);

        $task = Task::find($taskId);
    	$message = new Message;

        $message->sender = \Auth::id();
        $message->reciever = $task->register;
        $message->subject = $request->subject;
        $message->sentence = $request->sentence;
        $message->status = "unread";

        $message->save();

        return view ('message.askCheck',[
            'message' => $message,
            'task' => $task,
        ]);
    }

    public function askSend($messageId, $taskId)
    {
        $message = Message::find($messageId);
        $task = Task::find($taskId);
        $reciever = User::find($message->reciever);

        Mail::to($reciever->email)->send(new SendMessage($message));

        return redirect (route('tasks.show',[
        'task' => $task,     
        ]));
    }

    public function askEdit($messageId, $taskId)
    {
        $message = Message::find($messageId);
        $task = Task::find($taskId);
        
        return view ('message.askEdit',[
            'message' => $message,
            'task' => $task,
        ]);
    }

    public function askUpdate(Request $request, $messageId, $taskId)
    {
        $message = Message::find($messageId);
        $task = Task::find($taskId);
        
        $message->subject = $request->subject;
        $message->sentence = $request->sentence;
        $message->status = 'unread';

        $message->save();

        return view ('message.askCheck',[
            'message' => $message,
            'task' => $task,
        ]);
    }

    public function askUnsent($messageId, $taskId)
    {
        $message = Message::find($messageId);
        $task = Task::find($taskId);

        $message->status ='unsent';
        $message->save();

        return redirect (route('tasks.show',[
            'task' => $task,
        ]));
    }
    public function askPreDelete($messageId, $taskId)
    {

        $message = Message::find($messageId);
        $task = Task::find($taskId);


        return view ('message.askDelete',[
            'message' => $message,
            'task' => $task,
        ]);
    }
    public function askDelete(Request $request, $messageId, $taskId)
    {
        $message = Message::find($messageId);
        $task = Task::find($taskId);

        if(($request->email)==\Auth::user()->email){

            $message->delete();

        return redirect(route('tasks.show',[
            'task' => $task,
        ]));
        }

        return view('message.askCantDelete',[
            'message' => $message,
            'task' => $task,
        ]);
    }









    public function test()
    {

    	$message = new Message;
        $reciever = User::find(2);

        $message->sender = 1;
        $message->reciever = $reciever->id;
        $message->subject = 'hello';
        $message->sentence = 'hogehogehoge';
        $message->status = 'unread';
        $message->save();

    	/*Mail::send('message.send',$data,function($query)use($reciever,$message){
    	    $query->to($reciever->email,'三井')->subject($message->subject)->with($message);
    	});*/
            Mail::to($reciever->email)->send(new SendMessage($message));

        //return  redirect (route('users.index'));
    }
}
