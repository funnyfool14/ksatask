<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use \DB;
use App\Task;

class Team extends Model
{
    public function members()
    {
        return $this->belongsToMany(User::class,'teamsUsers','teamId','userId')->withTimestamps();
    }

    public function leader()
    {
        $id = $this->leader;
        return User::find($id);
    }

    public function deputy()
    {
            $id = $this->deputy;
            return User::find($id);
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'projectId')->first();
    }

    public function superiors()//特定のユーザの中からマネージャー以上をピックアップ
    {

        $leader = $this->leader;
        $superiorIds = \Auth::user()->company()->superior()->pluck('id');
        $ids = DB::table('teamsUsers')->where('teamId',$this->id)->where('userId','!=',$leader)
            ->whereIn('userId',$superiorIds)->pluck('userId');

        if($this->deputy){
            $ids = DB::table('teamsUsers')->where('teamId',$this->id)->where('userId','!=',$this->leader)
                ->where('userId','!=',$this->deputy)->whereIn('userId',$superiorIds)->pluck('userId');
        }
        return User::find($ids);
    }

    public function lowlyMembers()
    {  
        $lowlyIds = \Auth::user()->company()->lowly()->pluck('id');
        $ids = DB::table('teamsUsers')->where('teamId',$this->id)->where('userId','!=',$this->leader)->whereIn('userId',$lowlyIds)->pluck('userId');

        if($this->deputy){
            $ids = DB::table('teamsUsers')->where('teamId',$this->id)->where('userId','!=',$this->leader)
                ->where('userId','!=',$this->deputy)->whereIn('userId',$lowlyIds)->pluck('userId');
        }

        return User::find($ids);
    }

    public function membersLeader()
    { 
        $ids = DB::table('teamsUsers')->where('teamId',$this->id)->where('userId','!=',$this->leader)->pluck('userId');
        return User::find($ids);
    }

   public function users()
    {
        return $this->belongsToMany(User::class,'teamsUsers','teamId','userId')->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class,'teamId');
    }

    public function userTasks($userId)
    {
        $teamTaskIds = $this->tasks()->get()->pluck('id');
        $taskIds = DB::table('usersTasks')->whereIn('taskId',$teamTaskIds)
        ->where('userId',$userId)->pluck('taskId');

        return Task::find($taskIds);
    }
}
