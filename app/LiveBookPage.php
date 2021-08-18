<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveBookPage extends Model
{
    public function liveBook(){
        return $this->belongsTo(LiveBook::class);
    }
}
