<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Team;
use App\Task;
use DB;
use Request as PostRequest;

class User extends Authenticatable
{
    use Notifiable;
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class,'userId')->first();
    }

    public function company()
    {
        $profile = $this->profile();
        return $profile->belongsTo(Company::class,'companyId')->first();
    }

    public function existProfiles() //ユーザTOPページのボタン表示位置
    {
        if($this->profile()){
            if($this->profile()->where('maxim','!=',null)->orWhere('coment','!=',null)->exists()){
            return true;
            };
        };
        return false;
    }

    /*public function sentMessages()
    {
        return $this->hasMany(Message::class,'sender')->get();

        if(($messages->count())>0){
            return $messages;
        }
        return null;
    }*/

    public function sentMessages()
    {
        $messages = $this->hasMany(Message::class,'sender')->orderBy('id', 'desc')->paginate(7,['*'],'sentMessages')->appends(['recievedMessages' => PostRequest::input('recievedMessages'),'sentMessages' => PostRequest::input('sentMessages')]);
        
        if(($messages->count())>0){
            return $messages;
        }
        return null;
    } 

    public function recievedMessages()
    {
        $messages = $this->hasMany(Message::class,'reciever')->where('status','!=','unsent')->orderBy('id', 'desc')->paginate(7,['*'],'recirvedMessages')->appends(['recievedMessages' => PostRequest::input('recievedMessages'),'sentMessages' => PostRequest::input('sentMessages')]);
        
        if(($messages->count())>0){
            return $messages;
        }
        return null;
    } 

    public function position()
    {
        if($this->representative()){
            return '代表';
        }
        if($this->manager()|($this->profile()->post)==4){
            return 'マネージャー';
        }
        if($this->leader()){
            return 'リーダー';
        }
    }

    public function post()
    {
        return $this->profile()->post;
    }

    public function representative()//会社の代表者
    {
        if($this->profile()){
            if(($this->post())==5){
                return true;
            }
            return false;
        }
    }

    public function authority()//代表とそれと同等の権限を与えられた者
    {
        if($this->profile()){
            if(($this->post())>=4){
                return true;
            }
            return false;
        }
    }

    public function superior() //役職がマネージャー以上
    {
        if($this->profile()){
            if(($this->post())>=3){
                return true;
            }
            return false;
        }
    }

    public function manager()//マネージャー
    {
        if($this->profile()){
            if(($this->post())==3){
                return true;
            }
            return false;
        }
    }

    public function leader()
    {
        if($this->profile()){
            if(($this->post())==2){
                return true;
            }
            return false;
        }
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class,'usersTasks','userId','taskId')->withTimestamps();
    }

    public function makeTask($task)//タスクに自分を担当者登録
    {
        $this->tasks()->attach($task->id);
    }

    public function team()
    {
        return $this->belongsToMany(Team::class,'teamsUsers','userId','teamId')->withTimestamps();
    }

    public function isNotMember($teamId)
    {
        $team = Team::find($teamId);
        return $team->members()->where('userId',$this->id)->doesntExist();
    }

    public function notInChargeOf($taskId)
    {
        $task = Task::find($taskId);
        return DB::table('usersTasks')->where('taskId',$taskId)->where('userId',$this->id)->doesntExist();
    }

    public function privateTasks()
    {
        return $this->tasks()->private();
    }

    public function public()
    {
        $userId = $this->id;
            return Task::find(function($taskId)use($userId){
                $taskId->select('taskId')->from('usersTasks')->where('userId',$userId)->where('private','public');
            });
    }

    public function private()
    {
        $userId = $this->id;
            return Task::find(function($taskId)use($userId){
                $taskId->select('taskId')->from('usersTasks')->where('userId',$userId)->where('private','private');
            });
    }

    /*public function leaderPick()//foreachで回して使用
    {
        $profile = Profile::where('userId',$this->id)->where('post',2)->first();
        return $profile->user();
    }*/
}
