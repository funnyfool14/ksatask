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

    public function membersLeader()
    {  
        $leader = $this->leader;
        $lowlyIds = \Auth::user()->company()->lowly()->pluck('id');
        $ids = DB::table('teamsUsers')->where('teamId',$this->id)->where('userId','!=',$leader)->whereIn('userId',$lowlyIds)->pluck('userId');
        return User::find($ids);
    }

    public function membersDeputy()
    {  
        $leader = $this->leader;
        $deputy = $this->deputy;
        $ids = DB::table('teamsUsers')->where('teamId',$this->id)->where('userId','!=',$leader)->where('userId','!=',$deputy)->pluck('userId');
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
}
