<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function manager()
    {
        return User::find($this->manager);
    }

    public function teams()
    {
        return $this->hasMany(Team::class,'projectId')->get();
    }

    public function existTeam()
    {
        if ($this->hasMany(Team::class,'projectId')->exists()){
            return  true;
        }
        return false;
    }

    public function tasks()
    {
        $teamIds = $this->teams()->pluck('id');
        return Task::whereIn('teamId',$teamIds);
    }

    public function leaders($id)
    {
        $teams = $this->teams();
        foreach($teams as $team){
            if($team->where('leader',$id)){
                return true;
            }
        }
        return false;
    }

    public function notLeaders($id)
    {
        $leaderIds = $this->teams()->pluck('leader');
        foreach($leaderIds as $leaderId){
            if($leaderId==$id){
                return false;
            }
            return true;
        }
    }
}
