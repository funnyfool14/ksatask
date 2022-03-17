<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Request as PostRequest;
use Illuminate\Support\Facades\Storage;
use \App\User;
use \App\Task;
use \App\Profile;
use Request as UserRequest;
use \App\Message;
use Mail;
use \App\Mail\SendMessage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function top()
    {
        if(\Auth::check()){    
            $user = \Auth::user();
            $users = User::get();
            
            //if($user->tasks()->public()->get()){
            $highlowTasks = $user->tasks()->public()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highmidTasks = $user->tasks()->public()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highhighTasks = $user->tasks()->public()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midlowTasks = $user->tasks()->public()->midlow()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midmidTasks = $user->tasks()->public()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midhighTasks = $user->tasks()->public()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowlowTasks = $user->tasks()->public()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowmidTasks = $user->tasks()->public()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowhighTasks = $user->tasks()->public()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            //}

            return view ('user.show',[
                'user' => $user, 
                'users' => $users,
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
        return view('welcome');
    }

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
        $user = User::find($id);
        $users = User::get();
        
        //if($user->tasks()->get()){
            $highlowTasks = $user->tasks()->public()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highmidTasks = $user->tasks()->public()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highhighTasks = $user->tasks()->public()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midlowTasks = $user->tasks()->public()->midlow()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midmidTasks = $user->tasks()->public()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midhighTasks = $user->tasks()->public()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowlowTasks = $user->tasks()->public()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowmidTasks = $user->tasks()->public()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowhighTasks = $user->tasks()->public()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
        //}

        if(\Auth::id()==$user->id){
            return redirect(route('users.top'));
        }
            
        return view ('user.show',[
            'user' => $user, 
            'users' => $users,
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if(($user->profile())){
            $profile = $user->profile();

            if($user->profile()->companyId){

                return view('user.edit',[
                    'user' => $user,
                    'profile' => $profile,
                ]);
            };

            return view('company.belong',[
            'user' => $user,
            'profile' => $profile,
            ]);
        };

        $profile = new Profile;
        $profile->userId = $id;
        $profile->save();

        return view('company.belong',[
        'user' => $user,
        'profile' => $profile,
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
            'firstName'=>'required',
            'lastName'=>'required',
            'email'=>'required',
            'pic'=>'image'
            ]);

        $user = User::find($id);
        $profile = $user->profile();
        $user->firstName = $request->firstName; 
        $user->lastName = $request->lastName;
        $user->email = $request->email;


        $pic = $request->file('pic');
        if($pic){
            $path = $pic->store('storage','public');
            $user->pic = $path;
        }
        
        $user->save();

        $profile->maxim = $request->maxim;
        $profile->coment = $request->coment;
        $profile->save();

        return redirect(route('users.top'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function private($id)
    {
        $user = User::find($id);
        if((\Auth::id()==$id)){
            if($user->tasks()->private()->get()){
                $highlowTasks = $user->tasks()->private()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $highmidTasks = $user->tasks()->private()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $highhighTasks = $user->tasks()->private()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $midlowTasks = $user->tasks()->private()->midlow()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $midmidTasks = $user->tasks()->private()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $midhighTasks = $user->tasks()->private()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $lowlowTasks = $user->tasks()->private()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $lowmidTasks = $user->tasks()->private()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $lowhighTasks = $user->tasks()->private()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);

                return view ('user.private',[
                    'user' => $user, 
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
                return view ('user.private');
            }

        }
        return redirect (route('users.show',[
            'user' => $user,
        ]));
    }

    public function deadline($id)
    {
        $user = User::find($id);

        if($user->tasks()->deadline()->get()){
            if((\Auth::id())==$id){
                $highlowTasks = $user->tasks()->deadline()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $highmidTasks = $user->tasks()->deadline()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $highhighTasks = $user->tasks()->deadline()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $midlowTasks = $user->tasks()->deadline()->midlow()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $midmidTasks = $user->tasks()->deadline()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $midhighTasks = $user->tasks()->deadline()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $lowlowTasks = $user->tasks()->deadline()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $lowmidTasks = $user->tasks()->deadline()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
                $lowhighTasks = $user->tasks()->deadline()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);

                return view ('user.deadline',[
                    'user' => $user, 
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

            $highlowTasks = $user->tasks()->public()->deadline()->highlow()->paginate(4,['*'],'highlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highmidTasks = $user->tasks()->public()->deadline()->highmid()->paginate(4,['*'],'highmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $highhighTasks = $user->tasks()->public()->deadline()->highhigh()->paginate(4,['*'],'highhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midlowTasks = $user->tasks()->public()->deadline()->midlow()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midmidTasks = $user->tasks()->public()->deadline()->midmid()->paginate(4,['*'],'midmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $midhighTasks = $user->tasks()->public()->deadline()->midhigh()->paginate(4,['*'],'midhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowlowTasks = $user->tasks()->public()->deadline()->lowlow()->paginate(4,['*'],'lowlow')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowmidTasks = $user->tasks()->public()->deadline()->lowmid()->paginate(4,['*'],'lowmid')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);
            $lowhighTasks = $user->tasks()->public()->deadline()->lowhigh()->paginate(4,['*'],'lowhigh')->appends( ['highlow' => PostRequest::input('highlow') , 'highmid' => PostRequest::input('highmid') , 'highhigh' => PostRequest::input('highhigh') , 'midlow' => PostRequest::input('midlow') , 'midmid' => PostRequest::input('midmid') , 'midhigh' => PostRequest::input('midhigh') , 'lowlow' => PostRequest::input('lowlow') , 'lowmid' => PostRequest::input('lowmid') , 'lowhigh' => PostRequest::input('lowhigh')]);

            return view ('user.deadline',[
                'user' => $user, 
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
        
        return view ('user.deadline');

    }

    public function search(Request $request)
    {
        $search = UserRequest::get('name');
        $userIds = \Auth::user()->company()->users()->pluck('id');

        if($search){
            $users = User::query()->where('firstName','like','%'.$search.'%')->orWhere('lastName','like','%'.$search.'%')->whereIn('id',$userIds)->get()->exceptMe();
        }
        if(empty($search)){
            $users = User::query()->whereIn('id',$userIds)->get()->exceptMe();
        }

        return view ('company.index',[
            'users' => $users,
        ]);
    }

    public function prePromote($userId)
    {
        $user = User::find($userId);

        return view('user.promote',[
            'user' => $user,
        ]);
    }

    public function preDemote($userId)
    {
        $user = User::find($userId);

        return view('user.demote',[
            'user' => $user,
        ]);
    }

    public function promote(Request $request, $userId)
    {
        $user = User::find($userId);
        
        if(\Auth::user()->authority()){
            if(($request->personnelPass)==(\Auth::user()->company()->personnelPass)){

                $profile = $user->profile();

                if(($user->post())==1){
                    $profile->post=2;
                    $profile->save();
        
                    $message = new Message;
                    $message->sender = $user->company()->owner;
                    $message->reciever = $userId;
                    $message->subject = '昇格のお知らせ';
                    $message->sentence = '本日より'.$user->firstName.' '.$user->lastName." さんの\n一般社員の任を解きリーダーに昇格としました。";
                    $message->status = "unread";
        
                    $message->save();
        
                    $reciever = User::find($message->reciever);
                    Mail::to($reciever->email)->send(new SendMessage($message));

                return redirect(route('users.show',[
                    'user' => $user->id,
                    ]));
                }

                if(($user->post())==2){
                    $profile->post=3;
                    $profile->save();
        
                    $message = new Message;
                    $message->sender = $user->company()->owner;
                    $message->reciever = $userId;
                    $message->subject = '昇格のお知らせ';
                    $message->sentence = '本日より'.$user->firstName.' '.$user->lastName." さんの\nリーダーの任を解きマネージャーに昇格としました。";
                    $message->status = "unread";
        
                    $message->save();
        
                    $reciever = User::find($message->reciever);
                    Mail::to($reciever->email)->send(new SendMessage($message));
            
                    return redirect(route('users.show',[
                        'user' => $user->id,
                    ]));
                }
        
                if(($user->post())==3){
                    $profile->post=4;
                    $profile->save();
        
                    $message = new Message;
                    $message->sender = $user->company()->owner;
                    $message->reciever = $userId;
                    $message->subject = '昇格のお知らせ';
                    $message->sentence = '本日より'.$user->firstName.' '.$user->lastName.' さんに人事権をお渡しします。';
                    $message->status = "unread";
        
                    $message->save();
        
                    $reciever = User::find($message->reciever);
                    Mail::to($reciever->email)->send(new SendMessage($message));
            
                    return redirect(route('users.show',[
                        'user' => $user->id,
                    ]));
                }
            }

            return view ('user.cantPromote',[
                'user' => $user,
            ]);
        }

        return back();
    }

    public function demote(Request $request, $userId)
    {
        $user = User::find($userId);

        if(\Auth::user()->authority()){
            if(($request->personnelPass)==(\Auth::user()->company()->personnelPass)){
                $profile = $user->profile();

                if(($user->post())==2){
                    $profile->post=1;
                    $profile->save();
                }

                if(($user->post())==3){
                    $profile->post=2;
                    $profile->save();
                }
            
                if(($user->post())==4){
                    $profile->post=3;
                    $profile->save();
                }

                return redirect (route('users.show',[
                    'user' => $user,
                ]));

            }

            return view ('user.cantDemote',[
                'user' => $user,
            ]);
        }

        return back();

    }

    public function teams($id)
    {
        $user =User::find($id);
        $teams = $user->team()->get();

        return view('user.teams',[
            'user' => $user,
            'teams' => $teams,
        ]);
    }

    public function personnel($id)
    {
        $user =User::find($id);

        if(\Auth::user()->authority()){
            return view('user.personnel',[
                'user' => $user,
            ]);
        }

        return redirect (route('users.show',[
            'user' => $user,
        ]));
    }

    public function preRetirement ($userId)
    {
        $user = User::find($userId);

        return view('user.retirement',[
            'user' => $user,
        ]);
    }

    public function retirement (Request $request, $userId)
    {
        $user = User::find($userId);

        if(($request->personnelPass)==(\Auth::user()->company()->personnelPass)){
            $profile = $user->profile();
            $profile->companyId = null;
            $profile->post = 0;
            $profile->save();
            
            $user->tasks()->detach();

        return redirect (route('users.show',[
            'user' => \Auth::user(),
        ]));

        }

        return redirect (route('users.show',[
            'user' => $user,
        ]));

    }
}


