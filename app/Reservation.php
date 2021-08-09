<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function Provider()
    {
        return $this->belongsTo(Provider::class);
    }
    public function User(){
        return $this->belongsTo(User::class);
    }
}
