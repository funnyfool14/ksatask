<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender()
    {
        return User::find($this->sender);
    }

    public function reciever()
    {
        return User::find($this->reciever);
    }
}
