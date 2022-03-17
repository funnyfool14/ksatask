<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progresse extends Model
{

    public function date()
    {
        $date=\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at);
        return $date->format('m月d日');
    }

    public function today()
    {

        if(($this->date())==(\Carbon\Carbon::now()->format('m月d日'))){
            return true;
        };
        return false;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'userId')->first();
    }

}
