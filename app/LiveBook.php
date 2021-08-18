<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveBook extends Model
{
    public function provide(){
        return $this->belongsTo(Provider::class);

    }

    public function pages(){
        return $this->hasMany(LiveBookPage::class);
    }
}
