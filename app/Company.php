<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function profiles()
    {
        return $this->hasMany(Profile::class,'companyId')->get();
    }
    public function users()
    {
        $id = $this->hasMany(Profile::class,'companyId')->pluck('userId');
        return User::find($id);
    }

    public function projects()
    {
        return $this->hasMany(Project::class,'companyId')->get();
    }

    public function superior() //マネージャー以上の社員
    {
        $ids = $this->hasMany(Profile::class,'companyId')->where('post',5)->orWhere('post',4)->orWhere('post',3)->pluck('userId');
        return User::find($ids);
    }

    public function leaders() //リーダー以上の社員
    {
        $ids = $this->hasMany(Profile::class,'companyId')->where('post','>=',2)->pluck('userId');
        return User::find($ids);
    }

    public function lowly() //リーダー以下の社員
    {
        $ids = $this->hasMany(Profile::class,'companyId')->where('post','<=',2)->pluck('userId');
        return User::find($ids);
    }
    
}
