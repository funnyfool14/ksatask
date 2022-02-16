<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Macroable;
use DB;

class Task extends Model
{
    public function inCharge()
    {
        return $this->belongsToMany(User::class,'usersTasks','taskId','userId')->withTimestamps();
    }

    public function existInCharge()
    {
        if(DB::table('usersTasks')->where('taskId',$this->id)->exists()){
            return true;
        }
        return false;
    }

    public function register()
    {
        return User::find($this->register);
    }

    public function importance()
    {
        if(($this->importance)==1){
        return '高';
        }
        if(($this->importance)==2){
        return '中';
        }
        if(($this->importance)==3){
        return '低';
        }
    }

    public function urgency()
    {
        if(($this->urgency)==1){
            return '高';
        };
        if(($this->urgency)==2){
            return '中';
        };
        if(($this->urgency)==3){
            return '低';
        };
    }

    public function privateStatus()
    {
        if(($this->private)=='public'){
            return '公開';
        };
        if(($this->private)=='private'){
            return '非公開';
        };
    }

    public function team()
    {
        return Team::find($this->teamId);
    }
}
