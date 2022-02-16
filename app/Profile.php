<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class,'companyId')->first();
    }

    public function user()
    {
        return $this->belongTo(User::class,'userId')->first();
    }
}
