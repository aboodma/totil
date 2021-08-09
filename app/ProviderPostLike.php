<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderPostLike extends Model
{
    public function post()
    {
        return $this->belongsTo(ProviderPost::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
