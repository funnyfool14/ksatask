<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Message;
use App\User;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd('test');
        $message = Message::find($id);
        $user = User::find($message->reciever);

        $message->delete();

        return redirect(route('user.show',[
            'user'-> $user->id,
        ]));
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
